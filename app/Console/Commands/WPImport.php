<?php

namespace App\Console\Commands;

use App\Actions\SaveWpData;
use App\Http\Integrations\WP\Services\FetchWpData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WPImport extends Command
{
    protected string $productDataType = 'product';

    protected $signature = 'wp:import';

    public function __construct(
        private readonly FetchWpData $fetchService,
        private readonly SaveWpData  $saveWpDataAction
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->collectProducts();
    }

    /**
     * @return void
     * @throws \JsonException
     */
    private function collectProducts(): void
    {
        $page = 1;

        do {
            $this->info('Fetching products page: ' . $page);
            $response = $this->fetchService->fetch(
                type: 'products',
                page: $page,
            );

            if ($page === 1) {
                $this->info('Total pages: ' . $response->header(config('cnst.wp_headers.total_pages')));
            }

            foreach ($response->json() as $product) {

                $id = $product['id'] ?? null;
                if (!$id) {
                    throw new \Exception('Product id not found');
                }

                if (DB::table('wp_data')->where('key', $id)->where('type', $this->productDataType)->exists()) {
                    $this->warn('Product already exists: ' . $id);
                    continue;
                }

                $this->warn('Saving product raw data: ' . $id);
                $this->saveWpDataAction->handle(
                    data: $product,
                    dataType: $this->productDataType,
                    dataKey: $id,
                );

                $this->alert("Product {$id} complete!");
            }

            $this->alert("Products page {$page} complete!");
            $page++;

        } while ($response->header(config('cnst.wp_headers.total_pages')) >= $page);

        $this->info('Done!');
    }
}
