<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Enums\ProductStockStatus;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $guarded = false;

    protected $casts = [
        'type' => ProductType::class,
        'status' => ProductStatus::class,
        'stock_status' => ProductStockStatus::class,

        'names' => 'array',
        'descriptions' => 'array',
        'short_descriptions' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

//    public function attributes(): BelongsToMany
//    {
//        return $this->belongsToMany(Attribute::class, 'product_attributes');
//    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function upsells(): BelongsToMany
    {
        return $this->belongsToMany(ProductUpsell::class, 'product_upsells', 'product_id', 'upsell_product_id');
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(ProductRelated::class, 'product_related', 'product_id', 'related_product_id');
    }

    public function crosssells(): BelongsToMany
    {
        return $this->belongsToMany(ProductCrosssell::class, 'product_cross_sells', 'product_id', 'cross_sell_product_id');
    }

    public function grouped(): BelongsToMany
    {
        return $this->belongsToMany(ProductGrouped::class, 'product_grouped', 'product_id', 'child_product_id');
    }
}
