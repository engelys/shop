<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPTagResponse extends JSONModel
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
    public ?string $description = null;

    /**
     * @var ?int
     */
    public ?int $count = null;

    /**
     * @var ?WPTagResponseLinks
     */
    public ?WPTagResponseLinks $_links = null;
}
