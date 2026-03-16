<?php

namespace App\Models;

use App\Enums\OrderStatus;

class Order extends ImportModel
{
    protected $casts = [
        'status' => OrderStatus::class,
    ];
}
