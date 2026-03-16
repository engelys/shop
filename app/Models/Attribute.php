<?php

namespace App\Models;

class Attribute extends ImportModel
{
    protected $table = 'attr';

    protected $casts = [
        'names' => 'array'
    ];
}
