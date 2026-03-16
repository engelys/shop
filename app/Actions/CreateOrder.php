<?php

namespace App\Actions;

use App\Http\Integrations\WP\Models\WPOrderResponse;
use App\Models\Order;

class CreateOrder implements CreateAction
{
    public function handle(WPOrderResponse $recordDTO): void
    {
        if (!$recordDTO->id) {
            return;
        }

        if (Order::firstWhere('id', $recordDTO->id)) {
            return;
        }

        // $dto = new HotelDTO(...$recordDTO->toArray());

        $record = Order::create($recordDTO->toArray());
        $record->saveQuietly();
    }
}
