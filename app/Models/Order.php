<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    protected $keyType = 'int';
    protected $guarded = false;

    protected $casts = [
        'status' => OrderStatus::class
    ];
}
