<?php

namespace App\Http\Integrations\WP\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPTags extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/tags';
    }

    public function responseDto(): string
    {
        return '';
    }
}
