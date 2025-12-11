<?php

namespace App\Http\Integrations\WP\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPAttributes extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $page = 1,
        protected int $per_page = 10,
    )
    {
    }

    protected function defaultQuery(): array
    {
        return [
            'page' => $this->page,
            'per_page' => $this->per_page,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/attributes';
    }

    public function responseDto(): string
    {
        return '';
    }
}
