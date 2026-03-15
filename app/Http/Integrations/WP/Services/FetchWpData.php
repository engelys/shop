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

    private array $baseParams = [
        'page' => 1,
        'per_page' => 100
    ];

    public function __construct(
        private readonly \App\Http\Integrations\WP\WPConnector $connector,
    ){}

    public function fetch(string $type = 'product', array $paramsArr = []): \Saloon\Http\Response
    {
        return $this->connector->send($this->getRequest($type, $paramsArr));
    }

    private function getRequest(string $type, array $customParams = []): \Saloon\Http\Request
    {
        $params = new CollectionParams(...array_merge($this->baseParams, $customParams));

        $this->request = match ($type) {
            'product' => new WPProductsRequest($params)
        };

        return $this->request;
    }
}
