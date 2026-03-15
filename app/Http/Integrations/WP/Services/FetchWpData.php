<?php

namespace App\Http\Integrations\WP\Services;

use App\Http\Integrations\WP\Params\CollectionParams;
use App\Http\Integrations\WP\Requests\WPProductsRequest;

class FetchWpData
{
    // fetch data by type from wp and save into the wp_data table

    // allowed types:
    // product: product, product_cat, product_tag, media,
    // other: posts, pages, types, statuses, taxonomies, categories, tags, users, comments
    private \Saloon\Http\Request $request;

    public function __construct(
        private readonly \App\Http\Integrations\WP\WPConnector $connector,
    ){}

    public function fetch(string $type = 'product', int $page = 1, int $perPage = 100): \Saloon\Http\Response
    {
        return $this->connector->send($this->getRequest($type, $page, $perPage));
    }

    private function getRequest(string $type, int $page = 1, int $perPage = 100): \Saloon\Http\Request
    {
        $this->request = match ($type) {
            'products' => new WPProductsRequest(new CollectionParams(
                page: $page,
                per_page: $perPage,
            )),
        };

        return $this->request;
    }
}
