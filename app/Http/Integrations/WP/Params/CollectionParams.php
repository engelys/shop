<?php

namespace App\Http\Integrations\WP\Params;

use Spatie\LaravelData\Data;

class CollectionParams extends Data
{
    public int $page;
    public int $per_page;
}
