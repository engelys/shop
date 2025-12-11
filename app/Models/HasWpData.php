<?php

namespace App\Models;

trait HasWpData
{
    protected $type;

    protected $table = 'wp_data';

    protected $casts = [
        'data' => 'array'
    ];

    public function newEloquentBuilder($query)
    {
        return parent::newEloquentBuilder($query)
            ->where('type', $this->type);
    }
}