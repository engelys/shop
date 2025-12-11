<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\JSONModel;

class WPTagResponseTargetHints extends JSONModel
{
    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $allow = [];
}
