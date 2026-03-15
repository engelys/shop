<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPProductResponseDimensions extends JSONModel
{
    /**
     * @var ?string
     */
    public ?string $length = null;

    /**
     * @var ?string
     */
    public ?string $width = null;

    /**
     * @var ?string
     */
    public ?string $height = null;
}
