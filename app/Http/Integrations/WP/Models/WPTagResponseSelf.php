<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPTagResponseSelf extends JSONModel
{
    /**
     * @var ?string
     */
    public ?string $href = null;

    /**
     * @var ?WPTagResponseTargetHints
     */
    public ?WPTagResponseTargetHints $targetHints = null;
}
