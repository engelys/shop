<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Enums\ProductStockStatus;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends ImportModel
{
    protected $casts = [
        'type' => ProductType::class,
        'status' => ProductStatus::class,
        'stock_status' => ProductStockStatus::class,

        'names' => 'array',
        'images' => 'array',
        'descriptions' => 'array',
        'short_descriptions' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function main_image(): ?string
    {
        return array_first($this->images)['src'] ?? null;
    }
}
