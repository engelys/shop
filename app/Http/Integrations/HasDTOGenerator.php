<?php

namespace App\Http\Integrations;

use \Exception;
use Illuminate\Contracts\Container\BindingResolutionException;

trait HasDTOGenerator
{
    /**
     * Generate JSON models from response.
     *
     * @param string $requestClassName
     * @param string $body
     * @param string $basePath
     * @param string $baseNamespace
     * @return void
     *
     * @throws Exception
     * @throws BindingResolutionException
     */
    public function generateDTO(string $requestClassName, string $body, string $basePath, string $baseNamespace): void
    {
        $generator = new \Zamaldinov28\JsonModel\JSONGenerator(
            json: $body,
            documentRoot: '',
            namespace: $baseNamespace . '\\Models',
            rootPath: $basePath . DIRECTORY_SEPARATOR . 'Models',
            rootModel: $requestClassName . 'Response',
            strictTypes: true,
            overrideExists: true,
        );

        if (!$generator->generate()) {
            throw new Exception('Failed to generate dto models');
        }
    }
}
