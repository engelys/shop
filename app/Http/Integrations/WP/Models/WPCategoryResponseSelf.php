<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPCategoryResponseSelf extends JSONModel
{
    /**
     * @var ?string
     */
    public ?string $href = null;

    /**
     * @var ?WPCategoryResponseTargetHints
     */
    public ?WPCategoryResponseTargetHints $targetHints = null;
}
