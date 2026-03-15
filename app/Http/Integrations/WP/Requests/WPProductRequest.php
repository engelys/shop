<?php

namespace App\Http\Integrations\WP\Requests;

use Saloon\Http\Request;
use Saloon\Enums\Method;
use App\Http\Integrations\WP\Params\EntityParams;
use App\Http\Integrations\WP\Models\WPProductResponse;

class WPProductRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected EntityParams $params
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/' . $this->params->id;
    }

    public function responseDto(): string
    {
        return WPProductResponse::class;
    }
}
