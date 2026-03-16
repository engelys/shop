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
        'status' => OrderStatus::class,
        'line_items' => 'array',
        'shipping_lines' => 'array',
        'coupon_lines' => 'array',
        'refunds' => 'array',
        'tax_lines' => 'array',
        'fee_lines' => 'array',
    ];
}
