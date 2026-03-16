<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends ImportModel
{
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
