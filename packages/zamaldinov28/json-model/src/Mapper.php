<?php

declare(strict_types=1);

namespace Zamaldinov28\JsonModel;

interface Mapper
{
    /**
     * Apply string to be transformed, and return it.
     *
     * @param string $str
     *
     * @return string
     */
    public function map(string $str): string;
}
