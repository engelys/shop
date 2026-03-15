<?php

namespace App\Console\Commands;

use App\Http\Integrations\WP\Services\FetchWpData;
use Illuminate\Console\Command;
use App\Http\Integrations\WP\Services\WPImportService;

class WPImport extends Command
{

    protected $signature = 'wp:import';

    public function __construct(
        private readonly WPImportService $importService
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $types = [
            FetchWpData::PRODUCT,
            FetchWpData::PRODUCT_CAT,
            FetchWpData::PRODUCT_TAG,
            FetchWpData::PRODUCT_ATTR
        ];

        foreach ($types as $type) {
            $this->importService->collect(dataType: $type);
        }
    }
}
