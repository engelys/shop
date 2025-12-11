<?php

namespace App\Http\Integrations\WP\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPAttributes extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/attributes';
    }

    public function responseDto(): string
    {
        return '';
    }
}
