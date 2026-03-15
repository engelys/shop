<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\Attributes\AsArray;
use Zamaldinov28\JsonModel\JSONModel;

class WPProductResponse extends JSONModel
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
    public ?string $permalink = null;

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
    public ?string $type = null;

    /**
     * @var ?string
     */
    public ?string $status = null;

    /**
     * @var ?bool
     */
    public ?bool $featured = null;

    /**
     * @var ?string
     */
    public ?string $catalog_visibility = null;

    /**
     * @var ?string
     */
    public ?string $description = null;

    /**
     * @var ?string
     */
    public ?string $short_description = null;

    /**
     * @var ?string
     */
    public ?string $sku = null;

    /**
     * @var ?string
     */
    public ?string $price = null;

    /**
     * @var ?string
     */
    public ?string $regular_price = null;

    /**
     * @var ?string
     */
    public ?string $sale_price = null;

    /**
     * @var ?string
     */
    public ?string $date_on_sale_from = null;

    /**
     * @var ?string
     */
    public ?string $date_on_sale_from_gmt = null;

    /**
     * @var ?string
     */
    public ?string $date_on_sale_to = null;

    /**
     * @var ?string
     */
    public ?string $date_on_sale_to_gmt = null;

    /**
     * @var ?bool
     */
    public ?bool $on_sale = null;

    /**
     * @var ?bool
     */
    public ?bool $purchasable = null;

    /**
     * @var ?int
     */
    public ?int $total_sales = null;

    /**
     * @var ?bool
     */
    public ?bool $virtual = null;

    /**
     * @var ?bool
     */
    public ?bool $downloadable = null;

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $downloads = [];

    /**
     * @var ?int
     */
    public ?int $download_limit = null;

    /**
     * @var ?int
     */
    public ?int $download_expiry = null;

    /**
     * @var ?string
     */
    public ?string $external_url = null;

    /**
     * @var ?string
     */
    public ?string $button_text = null;

    /**
     * @var ?string
     */
    public ?string $tax_status = null;

    /**
     * @var ?string
     */
    public ?string $tax_class = null;

    /**
     * @var ?bool
     */
    public ?bool $manage_stock = null;

    /**
     * @var ?int
     */
    public ?int $stock_quantity = null;

    /**
     * @var ?string
     */
    public ?string $backorders = null;

    /**
     * @var ?bool
     */
    public ?bool $backorders_allowed = null;

    /**
     * @var ?bool
     */
    public ?bool $backordered = null;

    /**
     * @var ?string
     */
    public ?string $low_stock_amount = null;

    /**
     * @var ?bool
     */
    public ?bool $sold_individually = null;

    /**
     * @var ?string
     */
    public ?string $weight = null;

    /**
     * @var ?WPProductResponseDimensions
     */
    public ?WPProductResponseDimensions $dimensions = null;

    /**
     * @var ?bool
     */
    public ?bool $shipping_required = null;

    /**
     * @var ?bool
     */
    public ?bool $shipping_taxable = null;

    /**
     * @var ?string
     */
    public ?string $shipping_class = null;

    /**
     * @var ?int
     */
    public ?int $shipping_class_id = null;

    /**
     * @var ?bool
     */
    public ?bool $reviews_allowed = null;

    /**
     * @var ?string
     */
    public ?string $average_rating = null;

    /**
     * @var ?int
     */
    public ?int $rating_count = null;

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $upsell_ids = [];

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $cross_sell_ids = [];

    /**
     * @var ?int
     */
    public ?int $parent_id = null;

    /**
     * @var ?string
     */
    public ?string $purchase_note = null;

    /**
     * @var array<WPProductResponseCategories>
     */
    #[AsArray(itemType: WPProductResponseCategories::class)]
    public array $categories = [];

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $tags = [];

    /**
     * @var array<WPProductResponseImages>
     */
    #[AsArray(itemType: WPProductResponseImages::class)]
    public array $images = [];

    /**
     * @var array<WPProductResponseAttributes>
     */
    #[AsArray(itemType: WPProductResponseAttributes::class)]
    public array $attributes = [];

    /**
     * @var array<string>
     */
    #[AsArray(itemType: WPProductResponseDefaultAttribute::class)]
    public array $default_attributes = [];

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'integer')]
    public array $variations = [];

    /**
     * @var array<string>
     */
    #[AsArray(itemType: 'string')]
    public array $grouped_products = [];

    /**
     * @var ?int
     */
    public ?int $menu_order = null;

    /**
     * @var ?string
     */
    public ?string $price_html = null;

    /**
     * @var array<int>
     */
    #[AsArray(itemType: 'int')]
    public array $related_ids = [];

    /**
     * @var array<WPProductResponseMetaData>
     */
    #[AsArray(itemType: WPProductResponseMetaData::class)]
    public array $meta_data = [];

    /**
     * @var ?string
     */
    public ?string $stock_status = null;

    /**
     * @var ?bool
     */
    public ?bool $has_options = null;

    /**
     * @var ?string
     */
    public ?string $post_password = null;

    /**
     * @var ?string
     */
    public ?string $global_unique_id = null;
}
