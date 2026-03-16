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

        $record = Customer::create([
            'id' => $recordDTO->id,
            'email' => $recordDTO->email,
            'first_name' => $recordDTO->first_name,
            'last_name' => $recordDTO->last_name,
            'role' => $recordDTO->role,
            'username' => $recordDTO->username,
            'is_paying_customer' => $recordDTO->is_paying_customer,
            'avatar_url' => $recordDTO->avatar_url,
            'created_at' => $recordDTO->date_created,

            'billing' => $recordDTO->billing,
            'shipping' => $recordDTO->shipping,
        ]);

        $record->saveQuietly();
    }
}
