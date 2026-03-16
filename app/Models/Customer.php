<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $guarded = false;

    public function billing(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id')
            ->where('type', 'billing');
    }

    public function shipping(): HasOne
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id')
            ->where('type', 'shipping');
    }
}
