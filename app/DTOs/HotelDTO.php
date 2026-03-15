<?php

namespace App\DTOs;

class HotelDTO extends AutoConstructData
{
    public ?int $id = null;
    public ?string $name = null;
    public ?array $names = null;
    public ?string $slug = null;
    public ?string $permalink = null;
    public ?string $type = null;
    public ?string $status = null;
    public ?string $catalog_visibility = null;
    public ?string $sku = null;
    public ?string $regular_price = null;
    public ?string $sale_price = null;
    public ?string $date_on_sale_from = null;
    public ?string $date_on_sale_to = null;
    public ?string $external_url = null;
    public ?string $low_stock_amount = null;
    public ?string $weight = null;
    public ?string $shipping_class = null;
    public ?string $average_rating = null;
    public ?string $stock_status = null;
    public ?string $price_html = null;
    public ?string $description = null;
    public ?string $short_description = null;
    public ?array $descriptions = null;
    public ?array $short_descriptions = null;
    public ?bool $featured = null;
    public ?bool $on_sale = null;
    public ?bool $purchasable = null;
    public ?bool $virtual = null;
    public ?bool $downloadable = null;
    public ?bool $manage_stock = null;
    public ?bool $sold_individually = null;
    public ?bool $shipping_required = null;
    public ?bool $shipping_taxable = null;
    public ?bool $reviews_allowed = null;
    public ?bool $has_options = null;
    public ?string $price = null;
    public ?int $total_sales = null;
    public ?int $stock_quantity = null;
    public ?int $shipping_class_id = null;
    public ?int $rating_count = null;
    public ?int $menu_order = null;
    public ?int $parent_id = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
