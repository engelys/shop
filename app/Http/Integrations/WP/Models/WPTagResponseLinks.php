<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\JSONModel;

class WPTagResponseLinks extends JSONModel
{
    /**
     * @var array<WPTagResponseSelf>
     */
    #[AsArray(itemType: WPTagResponseSelf::class)]
    public array $self = [];

    /**
     * @var array<WPTagResponseCollection>
     */
    #[AsArray(itemType: WPTagResponseCollection::class)]
    public array $collection = [];
}
