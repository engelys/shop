<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Models\WPTagResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPTag extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $id = 1937
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/tags/' . $this->id;
    }

    public function responseDto(): string
    {
        return WPTagResponse::class;
    }
}
