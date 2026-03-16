<?php

namespace App\Actions;

use App\DTOs\HotelDTO;
use App\Http\Integrations\WP\Models\WPProductResponse;
use App\Models\Product;

class CreateProduct implements CreateAction
{
    public function handle(WPProductResponse $recordDTO): void
    {
        if (!$recordDTO->id) {
            return;
        }

        if (Product::firstWhere('id', $recordDTO->id)) {
            return;
        }

        $hotelDTO = new HotelDTO(...$recordDTO->toArray());

        $product = Product::create($hotelDTO->toArray());

        $product->saveQuietly();
    }
}
