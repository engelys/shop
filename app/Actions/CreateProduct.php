<?php

namespace App\Actions;

use App\DTOs\HotelDTO;
use App\Http\Integrations\WP\Models\WPProductResponse;
use App\Models\Product;

class CreateProduct
{
    public function handle(WPProductResponse $productDTO): void
    {
        if (!$productDTO->id) {
            return;
        }

        if (Product::firstWhere('id', $productDTO->id)) {
            return;
        }

        $hotelDTO = new HotelDTO(...$productDTO->toArray());

        $product = Product::create($hotelDTO->toArray());

        $product->saveQuietly();
    }
}
