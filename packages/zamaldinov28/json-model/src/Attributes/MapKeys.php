<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel\Attributes;

use Attribute;
use Exception;
use Zamaldinov28\JsonModel\Mapper;

#[Attribute(Attribute::TARGET_CLASS)]
class MapKeys
{
    public function __construct(
        public string $mapper,
    ) {
        if (!class_exists($mapper)) {
            throw new Exception("Class {$mapper} is not exists");
        }

        if (!is_subclass_of($mapper, Mapper::class)) {
            throw new Exception("Class {$mapper} should implement " . Mapper::class);
        }
    }
}
