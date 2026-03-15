<?php

namespace App\Http\Integrations\WP\Services;

use App\Actions\SaveWpData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class WPImportService
{
    public function __construct(
        private FetchWpData $fetchService,
        private SaveWpData  $saveWpDataAction
    )
    {
    }

    /**
     * @return void
     * @description collect wp data
     *
     * @throws \JsonException
     */
    public function collectProducts(): void
    {
        $dataType = 'product';
        $logger = Log::channel('wp_import_products');

        $page = 1;

        do {
            $logger->info('Fetching products page: ' . $page);
            $response = $this->fetchService->fetch(
                type: $dataType,
                page: $page,
            );

            if ($page === 1) {
                $logger->info('Total pages: ' . $response->header(config('cnst.wp_headers.total_pages')));
            }

            foreach ($response->json() as $product) {

                if (!$id = $product['id'] ?? null) {
                    throw new \Exception('Product id not found');
                }

                if (DB::table('wp_data')->where('key', $id)->where('type', $dataType)->exists()) {
                    $logger->warning('Product already exists: ' . $id);
                    continue;
                }

                $logger->warning('Saving product raw data: ' . $id);
                $this->saveWpDataAction->handle(
                    data: $product,
                    dataType: $dataType,
                    dataKey: $id,
                );

                $logger->alert("Product {$id} complete!");
            }

            $logger->alert("Products page {$page} complete!");
            $page++;

        } while ($response->header(config('cnst.wp_headers.total_pages')) >= $page);

        $logger->info('Done!');
    }

    // import raw wp data into wp_data table
    // import vocabularies
    // import products with relations
}
