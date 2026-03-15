<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel;

use Exception;
use ReflectionClass;
use stdClass;
use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\Attributes\Map;
use Zamaldinov28\JsonModel\Attributes\MapKeys;

class JSONModel
{
    /**
     * Parse json from string, array, \stdClass.
     *
     * @param string|array|stdClass $json
     */
    public function __construct(string|array|stdClass $json)
    {
        try {
            if (is_string($json)) {
                $json = json_decode($json);
            } elseif (is_array($json)) {
                $json = json_decode(json_encode($json));
            }
            if (!($json instanceof stdClass)) {
                return;
            }
        } catch (Exception $e) {
            return;
        }

        $this->parseFromStdClass($json);
    }

    /**
     * Parse \stdClass to special json model.
     *
     * @param stdClass $json
     *
     * @return void
     */
    private function parseFromStdClass(stdClass $json): void
    {
        $reflection = new ReflectionClass($this);
        $keyMapper  = null;
        foreach ($reflection->getAttributes(MapKeys::class) as $attribute) {
            $arguments = $attribute->getArguments();
            $className = array_shift($arguments);
            $keyMapper = new $className(...$arguments);
        }
        /** @var ?Mapper $keyMapper */

        foreach ($reflection->getProperties() as $property) {
            $key = $property->getName();
            if (null !== $keyMapper) {
                $key = $keyMapper->map($key);
            }
            foreach ($property->getAttributes(Map::class) as $attribute) {
                $key = $attribute->getArguments()['name'] ?? $key;
            }

            if (!isset($json->{$key})) {
                continue;
            }

            $tmpValue = $json->{$key};

            $tmpType = $property->getType()->getName();

            if ('array' !== $tmpType) {
                $property->setValue($this, $this->castType($tmpType, $tmpValue));

                continue;
            }

            // From here property is an array.

            $this->{$property->getName()} = [];

            $arrayType = config('json_model.default_array_type', 'string');
            foreach ($property->getAttributes(AsArray::class) as $attribute) {
                $arrayType = $attribute->getArguments()['itemType'] ?? $arrayType;
            }

            foreach ($tmpValue as $value) {
                if (empty($value)) {
                    continue;
                }

                $this->{$property->getName()}[] = $this->castType($arrayType, $value);
            }
        }
    }

    /**
     * Convert item to any type except array, and object.
     *
     * @param string $type
     * @param mixed $item
     *
     * @return mixed
     */
    private function castType(string $type, mixed $item): mixed
    {
        if ('mixed' === $type) {
            return $item;
        }

        if ($item instanceof stdClass && !class_exists($type)) {
            throw new Exception('Object could not be converted to scalar type');
        }

        return match ($type) {
            'string' => (string) $item,
            'int', 'integer' => (int) $item,
            'float', 'double' => (float) $item,
            'bool'  => boolval($item),
            default => (new $type($item)),
        };
    }
}
