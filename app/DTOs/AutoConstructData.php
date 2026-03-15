<?php

namespace App\DTOs;

use ReflectionClass;
use Spatie\LaravelData\Data;

class AutoConstructData extends Data
{
    public function __construct(...$payload)
    {
        $class = new ReflectionClass(static::class);

        foreach ($payload as $key => $value) {
            if (! $class->hasProperty($key)) {
                continue;
            }

            $property = $class->getProperty($key);
            $type = $property->getType();

            // No type or null → assign directly
            if ($value === null || ! $type instanceof \ReflectionNamedType) {
                $this->{$key} = $value;

                continue;
            }

            $typeName = $type->getName();

            // Nested DTO hydration
            if (is_array($value) && is_subclass_of($typeName, AutoConstructData::class)) {
                $this->{$key} = new $typeName($value);

                continue;
            }

            $this->{$key} = $value;
        }
    }
}
