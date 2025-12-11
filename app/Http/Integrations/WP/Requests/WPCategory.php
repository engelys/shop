<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Models\WPCategoryResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPCategory extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id = 85
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/categories/' . $this->id;
    }

    public function responseDto(): string
    {
        return WPCategoryResponse::class;
    }
}
