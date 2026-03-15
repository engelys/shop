<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel;

use Exception;
use Illuminate\Support\Facades\File;
use stdClass;

class JSONGenerator
{
    private const KEY_TYPE         = 'type';
    private const KEY_IS_ARRAY     = 'is_array';
    private const KEY_SUBSTRUCTURE = 'substructure';

    /**
     * @var array<string,array>
     */
    private array $generatedClasses = [];

    public function __construct(
        private string $json = '',
        private string $documentRoot = '',
        private string $namespace = '',
        private string $rootPath = '',
        private string $rootModel = '',
        private bool $strictTypes = true,
        private bool $overrideExists = false,
    ) {
    }

    /**
     * Set json document to generate models.
     *
     * @param string $json
     *
     * @return self
     */
    public function setJsonString(string $json): self
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Set element, from with models will be created.
     *
     * @param string $root
     *
     * @return self
     */
    public function setDocumentRoot(string $root): self
    {
        $this->documentRoot = $root;

        return $this;
    }

    /**
     * Set models namespace. Also will be used for path, in case no path specified.
     *
     * @param string $namespace
     *
     * @return self
     */
    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Set base path for files.
     *
     * @param string $path
     *
     * @return self
     */
    public function setRoomPath(string $path): self
    {
        $this->rootPath = $path;

        return $this;
    }

    /**
     * Set root model filename without extensions.
     *
     * @param string $namespace
     *
     * @return self
     */
    public function setRootModel(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Create files with strict types statement.
     *
     * @param bool $add
     *
     * @return self
     */
    public function setStrictTypes(bool $add): self
    {
        $this->strictTypes = $add;

        return $this;
    }

    /**
     * Ignore file, if its already exists.
     *
     * @param bool $override
     *
     * @return self
     */
    public function setOverrideExists(bool $override): self
    {
        $this->overrideExists = $override;

        return $this;
    }

    /**
     * Run generation.
     *
     * @return bool
     */
    public function generate(): bool
    {
        if (!str_ends_with($this->namespace, '\\')) {
            $this->namespace .= '\\';
        }

        if (empty($this->json)) {
            throw new Exception('JSON string could not be empty');
        }

        $root      = json_decode($this->json);
        $structure = $this->proceedNode($root);

        $filesStructure = [
            self::KEY_TYPE         => $this->propertyType(''),
            self::KEY_SUBSTRUCTURE => $structure,
        ];
        $this->buildFile($filesStructure);

        return true;
    }

    /**
     * Find unique (for current generation) class name.
     *
     * @param array $params
     *
     * @return string
     */
    protected function resolveClassName(array $params): string
    {
        $className = $params[self::KEY_TYPE];

        if (!isset($this->generatedClasses[$className])) {
            $this->generatedClasses[$className] = $params[self::KEY_SUBSTRUCTURE];

            return $className;
        }

        for ($i = 1; true; $i++) {
            $tmpClassName = $className . $i;

            if (isset($this->generatedClasses[$tmpClassName])) {
                continue;
            }

            $this->generatedClasses[$tmpClassName] = $params[self::KEY_SUBSTRUCTURE];

            return $tmpClassName;
        }
    }

    /**
     * Recursively parse and convert node to model.
     *
     * @param stdClass $node
     *
     * @return array
     */
    private function proceedNode(stdClass $node): array
    {
        $properties = [];

        foreach (get_object_vars($node) as $name => $property) {
            if (empty($properties[$name])) {
                $properties[$name] = [];
            }
            if (null !== $property) {
                $properties[$name][self::KEY_TYPE] = get_debug_type($property);
            }

            // Handle case when it's an array, but with numeric keys (so parsed as object).
            if (is_object($property)) {
                $justNumericKeys = true;
                foreach (array_keys(get_object_vars($property)) as $key) {
                    $justNumericKeys = $justNumericKeys && is_numeric($key);
                }
                if ($justNumericKeys) {
                    $property = (array) $property;
                }
            }

            if (is_array($property)) {
                $properties[$name][self::KEY_IS_ARRAY] = true;
                $properties[$name][self::KEY_TYPE]     = is_object($property[0] ?? false) ? $this->propertyType($name) : get_debug_type($property[0] ?? '');
                if (is_object($property[0] ?? false)) {
                    foreach ($property as $subProperty) {
                        $properties[$name][self::KEY_SUBSTRUCTURE] = $this->arrayMergeRecursiveDistinct($properties[$name][self::KEY_SUBSTRUCTURE] ?? [], $this->proceedNode($subProperty));
                    }
                }
            } elseif (is_object($property)) {
                $properties[$name][self::KEY_TYPE]         = $this->propertyType($name);
                $properties[$name][self::KEY_SUBSTRUCTURE] = $this->proceedNode($property);
            }
        }

        return $properties;
    }

    /**
     * Build node's property type.
     *
     * @param string $name
     *
     * @return string
     */
    private function propertyType(string $name): string
    {
        return $this->namespace . $this->rootModel . str_replace(['-', '_'], '', ucwords($name, '-_'));
    }

    /**
     * Build model from parameters.
     *
     * @param array $params
     *
     * @return bool
     */
    private function buildFile(array &$params): bool
    {
        $if = static function ($condition, $true, $false) {
            return $condition ? $true : $false;
        };
        $globalNamespace = __NAMESPACE__;

        $params[self::KEY_TYPE] = $this->resolveClassName($params);

        $namespace = substr($params[self::KEY_TYPE], 0, strrpos($params[self::KEY_TYPE], '\\'));
        $className = substr($params[self::KEY_TYPE], strrpos($params[self::KEY_TYPE], '\\') + 1);
        $use       = [
            "use {$globalNamespace}\JSONModel;" => true,
        ];

        $properties = [];
        foreach ($params[self::KEY_SUBSTRUCTURE] as $subName => $subParams) {
            if (empty($subParams[self::KEY_TYPE])) {
                $subParams[self::KEY_TYPE] = 'string';
            }

            $isArray          = $subParams[self::KEY_IS_ARRAY] ?? false;
            $isArrayOfObjects = false;
            if (str_contains($subParams[self::KEY_TYPE], '\\')) {
                $this->buildFile($subParams);
                $isArrayOfObjects          = true;
                $subParams[self::KEY_TYPE] = substr($subParams[self::KEY_TYPE], strrpos($subParams[self::KEY_TYPE], '\\') + 1);
            }

            $type = $subParams[self::KEY_TYPE];

            $attributes = [];

            // Clear property name
            if (0 === preg_match('/^[a-zA-Z0-9_]+$/', $subName)) {
                $use["use {$globalNamespace}\Attributes\Map;"] = true;
                $attributes[]                                  = '    #[Map(' . var_export($subName, true) . ')]';
                $subName                                       = preg_replace('/[^a-zA-Z0-9_]/', '', $subName);
            }

            if ($isArray) {
                $use["use {$globalNamespace}\Attributes\AsArray;"] = true;
                $attributes[]                                      = "    #[AsArray(itemType: {$if($isArrayOfObjects, $type . '::class', '\'' . $type . '\'')})]";
            }

            $properties[] = <<<PHP
    /**
     * @var {$if($isArray, "array<{$type}>", "?{$type}")}
     */{$if(empty($attributes), '', "\n" . implode("\n", $attributes))}
    public {$if($isArray, 'array', "?{$type}")} \${$subName} = {$if($isArray, '[]', 'null')};
PHP;
        }

        ksort($use);
        $use = array_keys($use);

        $file = <<<PHP
<?php

{$if($this->strictTypes, "declare(strict_types=1);\n", '')}
namespace {$namespace};
{$if(empty($use), '', "\n" . implode("\n", $use) . "\n")}
class {$className} extends JSONModel
{{$if(empty($properties), '', "\n" . implode("\n\n", $properties))}
}

PHP;

        $dirPath = $this->rootPath ?: str_replace('\\', '/', $className);

        if (!File::isDirectory($dirPath))
            File::makeDirectory($dirPath, 0755, true);

        $fileName = $dirPath . DIRECTORY_SEPARATOR . $className . '.php';

        if (!$this->overrideExists && is_file($fileName)) {
            return true;
        }

        return false !== file_put_contents($fileName, $file);
    }

    /**
     * Recursively merge to arrays with override, if needed.
     *
     * @param array<int|string, mixed> $array1
     * @param array<int|string, mixed> $array2
     *
     * @return array<int|string, mixed>
     */
    private function arrayMergeRecursiveDistinct(array $array1, array $array2): array
    {
        $merged = $array1;
        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::arrayMergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
