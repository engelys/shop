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

    // TODO import products with relations

    public function collect(string $dataType, bool $debug = false): void
    {
        $logger = Log::channel('wp_import');

        $page = 1;

        do {
            $logger->info(sprintf('%s: Fetching page: %s', $dataType, $page));
            $response = $this->fetchService->fetch(
                type: $dataType,
                page: $page,
            );

            if ($page === 1) {
                $logger->info(sprintf('%s: Total count: %s ', mb_strtoupper($dataType), $response->header(config('cnst.wp_headers.total_pages'))));
            }

            foreach ($response->json() as $record) {

                if (!$id = $record['id'] ?? null) {
                    throw new \Exception($dataType . ' id not found');
                }

                if (DB::table('wp_data')->where('key', $id)->where('type', $dataType)->exists()) {
                    $logger->warning(sprintf('%s: already exists: %s', mb_strtoupper($dataType), $id));
                    continue;
                }

                // import raw wp data into wp_data table
                $logger->warning(sprintf('%s: Saving raw data: %s', mb_strtoupper($dataType), $id));
                $this->saveWpDataAction->handle(
                    data: $record,
                    dataType: $dataType,
                    dataKey: $id,
                );

                $logger->alert(sprintf('%s: Save raw record %s complete!', mb_strtoupper($dataType), $id));
            }

            $logger->alert(sprintf('%s: Page %s complete!', mb_strtoupper($dataType), $page));
            $page++;

            if ($debug) {
                dd(sprintf('%s: Debug', mb_strtoupper($dataType)));
            }

        } while ($response->header(config('cnst.wp_headers.total_pages')) >= $page);

        $logger->info(sprintf('%s: Done!', mb_strtoupper($dataType)));
    }
}
