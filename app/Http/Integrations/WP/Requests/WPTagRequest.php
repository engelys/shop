<?php

namespace App\Http\Integrations\WP\Requests;

use App\Http\Integrations\WP\Models\WPTagResponse;
use App\Http\Integrations\WP\Params\EntityParams;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class WPTagRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected EntityParams $params
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/wp-json/wc/v3/products/tags/' . $this->params->id;
    }

    public function responseDto(): string
    {
        return WPTagResponse::class;
    }
}
