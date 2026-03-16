<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPAttrResponse extends JSONModel
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
     * @var ?string
     */
    public ?string $type = null;

    /**
     * @var ?string
     */
    public ?string $order_by = null;

    /**
     * @var ?string
     */
    public ?string $has_archives = null;

}
