<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Params\CollectionParams;
use Saloon\Http\Request;
use Saloon\Enums\Method;

class WPCustomersRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected CollectionParams $params
    )
    {
    }

    protected function defaultQuery(): array
    {
        return $this->params->all();
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/customers';
    }

    public function responseDto(): string
    {
        return \App\Http\Integrations\WP\Models\WPCustomerResponse::class;
    }
}
