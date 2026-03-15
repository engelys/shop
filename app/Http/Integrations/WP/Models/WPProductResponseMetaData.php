<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPProductResponseMetaData extends JSONModel
{
    /**
     * @var ?int
     */
    public ?int $id = null;

    /**
     * @var ?string
     */
    public ?string $key = null;

    /**
     * @var mixed
     */
    public mixed $value = null;
}
