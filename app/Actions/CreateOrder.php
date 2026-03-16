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

        if ($recordDTO->customer_id === 0) {
            $recordDTO->customer_id = null;
        }

        $record = Order::create($recordDTO->toArray());
        $record->saveQuietly();
    }
}
