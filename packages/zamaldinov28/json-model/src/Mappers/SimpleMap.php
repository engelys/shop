<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel\Mappers;

use Zamaldinov28\JsonModel\Mapper;

class SimpleMap implements Mapper
{
    public function __construct(
        public string $function,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function map(string $str): string
    {
        return call_user_func($this->function, $str);
    }
}
