<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPCategoryResponseImage extends JSONModel
{
    /**
     * @var ?int
     */
    public ?int $id = null;

    /**
     * @var ?string
     */
    public ?string $date_created = null;

    /**
     * @var ?string
     */
    public ?string $date_created_gmt = null;

    /**
     * @var ?string
     */
    public ?string $date_modified = null;

    /**
     * @var ?string
     */
    public ?string $date_modified_gmt = null;

    /**
     * @var ?string
     */
    public ?string $src = null;

    /**
     * @var ?string
     */
    public ?string $name = null;

    /**
     * @var ?string
     */
    public ?string $alt = null;
}
