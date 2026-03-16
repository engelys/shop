<?php

namespace App\Http\Integrations\WP\Services;

use App\Actions;
use App\Http\Integrations\WP\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final readonly class WPImportService
{
    public function __construct(
        private FetchWpData            $fetchService,
        private Actions\SaveWpData     $saveWpDataAction,
        private Actions\CreateProduct  $createProductAction,
        private Actions\CreateCategory $createCategoryAction,
        private Actions\CreateAttr     $createAttrAction,
        private Actions\CreateCustomer $createCustomerAction,
        private Actions\CreateOrder $createOrderAction,
    )
    {
    }

    public function import(string $dataType, bool $debug = false): void
    {
        $logger = Log::channel('wp_import');

        $records = DB::table('wp_data')->where('type', $dataType);

        if ($records->count() === 0) {
            $logger->error(sprintf('%s: There are no records to import', mb_strtoupper($dataType)));
            return;
        }

        $dataClass = $this->getDataClassByType($dataType);

        foreach ($records->cursor() as $record) {
            $dto = new $dataClass($record->data);

            if ($debug) {
                dd($dto);
            }

            if (!$actionClass = $this->getCreateActionByType($dataType)) {
                throw new \Exception('Not implemented yet');
            }

            $actionClass->handle($dto);

            $logger->info(sprintf('%s: Imported: %s', mb_strtoupper($dataType), $record->key));
        }
    }

    private function getCreateActionByType(string $dataType): Actions\CreateAction
    {
        return match ($dataType) {
            FetchWpData::PRODUCT => $this->createProductAction,
            FetchWpData::PRODUCT_CAT => $this->createCategoryAction,
            //FetchWpData::PRODUCT_TAG => $this->createTagAction,
            FetchWpData::PRODUCT_ATTR => $this->createAttrAction,
            FetchWpData::CUSTOMERS => $this->createCustomerAction,
            FetchWpData::ORDERS => $this->createOrderAction,
        };
    }

    private function getDataClassByType(string $dataType): string
    {
        return match ($dataType) {
            FetchWpData::PRODUCT => Models\WPProductResponse::class,
            FetchWpData::PRODUCT_CAT => Models\WPCategoryResponse::class,
            FetchWpData::PRODUCT_TAG => Models\WPTagResponse::class,
            FetchWpData::PRODUCT_ATTR => Models\WPAttrResponse::class,
            FetchWpData::CUSTOMERS => Models\WPCustomerResponse::class,
            FetchWpData::ORDERS => Models\WPOrderResponse::class,
        };
    }

    public function collect(string $dataType, bool $debug = false): void
    {
        $logger = Log::channel('wp_import');

        $page = 1;

        do {
            $logger->info(sprintf('%s: Fetching page: %s', mb_strtoupper($dataType), $page));
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
