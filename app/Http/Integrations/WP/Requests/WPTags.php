<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Params\CollectionParams;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPTags extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected CollectionParams $params
    )
    {
    }

    protected function defaultQuery(): array
    {
        return array_merge([
            '_fields' => 'id'
        ], $this->params->all());
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/tags';
    }

    public function responseDto(): string
    {
        return '';
    }
}
