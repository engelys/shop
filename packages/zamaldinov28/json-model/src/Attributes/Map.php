<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Map
{
    public function __construct(
        public string $name,
    ) {
    }
}
