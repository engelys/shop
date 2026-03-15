<?php

namespace App\Http\Integrations\WP\Params;

use App\DTOs\AutoConstructData;

class CollectionParams extends AutoConstructData
{
    public int $page;
    public int $per_page;
}
