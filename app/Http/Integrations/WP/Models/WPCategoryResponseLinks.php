<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\JSONModel;

class WPCategoryResponseLinks extends JSONModel
{
    /**
     * @var array<WPCategoryResponseSelf>
     */
    #[AsArray(itemType: WPCategoryResponseSelf::class)]
    public array $self = [];

    /**
     * @var array<WPCategoryResponseCollection>
     */
    #[AsArray(itemType: WPCategoryResponseCollection::class)]
    public array $collection = [];

    /**
     * @var array<WPCategoryResponseUp>
     */
    #[AsArray(itemType: WPCategoryResponseUp::class)]
    public array $up = [];
}
