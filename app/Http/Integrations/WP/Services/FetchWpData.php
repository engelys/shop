<?php

namespace App\Http\Integrations\WP\Services;

use App\Http\Integrations\WP\Params\CollectionParams;
use App\Http\Integrations\WP\Requests;

class FetchWpData
{
    public const PRODUCT = 'product';
    public const PRODUCT_ATTR = 'product_attr';
    public const PRODUCT_CAT = 'product_cat';
    public const PRODUCT_TAG = 'product_tag';
    public const CUSTOMERS = 'customers';

    // fetch data by type from wp and save into the wp_data table
    // other: posts, pages, types, statuses, taxonomies, categories, tags, users, comments
    private \Saloon\Http\Request $request;

    public function __construct(
        private readonly \App\Http\Integrations\WP\WPConnector $connector,
    )
    {
    }

    public function fetch(string $type = 'product', int $page = 1, int $perPage = 100): \Saloon\Http\Response
    {
        return $this->connector->send($this->getRequest($type, $page, $perPage));
    }

    private function getRequest(string $type, int $page = 1, int $perPage = 100): \Saloon\Http\Request
    {
        $this->request = match ($type) {
            self::PRODUCT => new Requests\WPProductsRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
            self::PRODUCT_ATTR => new Requests\WPAttributesRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
            self::PRODUCT_CAT => new Requests\WPCategoriesRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
            self::PRODUCT_TAG => new Requests\WPTagsRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
            self::CUSTOMERS => new Requests\WPCustomersRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
        };

        return $this->request;
    }
}
