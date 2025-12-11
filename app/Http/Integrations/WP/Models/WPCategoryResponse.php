<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPCategoryResponse extends JSONModel
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
    public ?string $slug = null;

    /**
     * @var ?int
     */
    public ?int $parent = null;

    /**
     * @var ?string
     */
    public ?string $description = null;

    /**
     * @var ?string
     */
    public ?string $display = null;

    /**
     * @var ?WPCategoryResponseImage
     */
    public ?WPCategoryResponseImage $image = null;

    /**
     * @var ?int
     */
    public ?int $menu_order = null;

    /**
     * @var ?int
     */
    public ?int $count = null;
}
