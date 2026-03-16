<?php

namespace App\Console\Commands;

use App\Http\Integrations\WP\Services\FetchWpData;
use Illuminate\Console\Command;
use App\Http\Integrations\WP\Services\WPImportService;

class WPImport extends Command
{
    protected $signature = 'wp:import';

    public function handle(): void
    {
        $importService = app(WPImportService::class);

        $types = [
            FetchWpData::PRODUCT,
            FetchWpData::PRODUCT_CAT,
            FetchWpData::PRODUCT_TAG,
            FetchWpData::PRODUCT_ATTR,
            FetchWpData::CUSTOMERS,
            FetchWpData::ORDERS
        ];

        foreach ($types as $type) {
            $importService->collect($type);
            $importService->import(dataType: $type);
        }
    }
}
