<?php

namespace App\Actions;

use App\Http\Integrations\WP\Models\WPCustomerResponse;
use App\Models\Customer;

class CreateCustomer implements CreateAction
{
    public function handle(WPCustomerResponse $recordDTO): void
    {
        if (!$recordDTO->id) {
            return;
        }

        if (Customer::firstWhere('id', $recordDTO->id)) {
            return;
        }

        $record = Customer::updateOrCreate([
            'id' => $recordDTO->id,
            'email' => $recordDTO->email,
            'username' => $recordDTO->username,
        ], [
            'first_name' => $recordDTO->first_name,
            'last_name' => $recordDTO->last_name,
            'role' => $recordDTO->role,
            'is_paying_customer' => $recordDTO->is_paying_customer,
            'avatar_url' => $recordDTO->avatar_url,
            'created_at' => $recordDTO->date_created,
        ]);

        $record->saveQuietly();

        $record->billing()->updateOrCreate([
            'customer_id' => $record->id,
            'type' => 'billing',
        ], $recordDTO->billing->all());

        $record->shipping()->updateOrCreate([
            'customer_id' => $record->id,
            'type' => 'shipping',
        ], $recordDTO->shipping->all());
    }
}
