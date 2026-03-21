<?php

namespace App\DTOs;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema()]
class HotelDTO extends AutoConstructData
{
    #[Property()]
    public ?int $id = null;

    #[Property()]
    public ?string $name = null;

    #[Property(items: new Items())]
    public ?array $names = null;

    #[Property()]
    public ?string $slug = null;

    #[Property()]
    public ?string $permalink = null;

    #[Property()]
    public ?string $type = null;

    #[Property()]
    public ?string $status = null;

    #[Property()]
    public ?string $catalog_visibility = null;

    #[Property()]
    public ?string $sku = null;

    #[Property()]
    public ?string $regular_price = null;

    #[Property()]
    public ?string $sale_price = null;

    #[Property()]
    public ?string $date_on_sale_from = null;

    #[Property()]
    public ?string $date_on_sale_to = null;

    #[Property()]
    public ?string $external_url = null;

    #[Property()]
    public ?string $low_stock_amount = null;

    #[Property()]
    public ?string $weight = null;

    #[Property()]
    public ?string $shipping_class = null;

    #[Property()]
    public ?string $average_rating = null;

    #[Property()]
    public ?string $stock_status = null;

    #[Property()]
    public ?string $price_html = null;

    #[Property()]
    public ?string $description = null;

    #[Property()]
    public ?string $short_description = null;

    #[Property(items: new Items())]
    public ?array $descriptions = null;

    #[Property(items: new Items())]
    public ?array $short_descriptions = null;

    #[Property(items: new Items())]
    public ?array $images = null;

    #[Property()]
    public ?bool $featured = null;

    #[Property()]
    public ?bool $on_sale = null;

    #[Property()]
    public ?bool $purchasable = null;

    #[Property()]
    public ?bool $virtual = null;

    #[Property()]
    public ?bool $downloadable = null;

    #[Property()]
    public ?bool $manage_stock = null;

    #[Property()]
    public ?bool $sold_individually = null;

    #[Property()]
    public ?bool $shipping_required = null;

    #[Property()]
    public ?bool $shipping_taxable = null;

    #[Property()]
    public ?bool $reviews_allowed = null;

    #[Property()]
    public ?bool $has_options = null;

    #[Property()]
    public ?string $price = null;

    #[Property()]
    public ?int $total_sales = null;

    #[Property()]
    public ?int $stock_quantity = null;

    #[Property()]
    public ?int $shipping_class_id = null;

    #[Property()]
    public ?int $rating_count = null;

    #[Property()]
    public ?int $menu_order = null;

    #[Property()]
    public ?int $parent_id = null;

    #[Property()]
    public ?string $created_at = null;

    #[Property()]
    public ?string $updated_at = null;
}
