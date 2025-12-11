<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WpData extends Model
{
    protected $table = 'wp_data';

    protected $casts = [
        'data' => 'array'
    ];

    public function newEloquentBuilder($query)
    {
        return parent::newEloquentBuilder($query)
            ->where('type', $this->wp_record_type);
    }
}