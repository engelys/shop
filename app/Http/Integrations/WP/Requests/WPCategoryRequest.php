<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Models\WPCategoryResponse;
use App\Http\Integrations\WP\Params\EntityParams;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPCategoryRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected EntityParams $params
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/categories/' . $this->params->id;
    }

    public function responseDto(): string
    {
        return WPCategoryResponse::class;
    }
}
