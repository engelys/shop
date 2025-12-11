<?php

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPProductResponseDefaultAttribute extends JSONModel
{
    /**
     * @var ?int
     */
    public ?int $id = null;

    /**
     * @var ?string
     */
    public ?string $name = null;

    /**
     * @var ?string
     */
    public ?string $option = null;
}