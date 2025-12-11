<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\JSONModel;

class WPProductResponseAttributes extends JSONModel
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
    public ?int $position = null;

    /**
     * @var ?bool
     */
    public ?bool $visible = null;

    /**
     * @var ?bool
     */
    public ?bool $variation = null;

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $options = [];
}
