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

        $hotelDTO = new HotelDTO(...$recordDTO->toArray());

        if (!$product = Product::firstWhere('id', $recordDTO->id)) {
            $product = Product::create($hotelDTO->toArray());
        }

        // $images = $recordDTO->images;
        // $tags = $recordDTO->tags; // array strings
        $categories = collect($recordDTO->categories)->pluck('id')->all();
        $product->categories()->sync($categories);

        $attributes = collect($recordDTO->attributes)->pluck('id')->all();
        $product->attributes()->sync($attributes);

        $product->saveQuietly();
    }
}
