<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatus;
use App\Enums\ProductStockStatus;
use App\Enums\ProductType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('names')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('permalink'),
                Select::make('type')
                    ->options(ProductType::class),
                Select::make('status')
                    ->options(ProductStatus::class),
                TextInput::make('catalog_visibility'),
                TextInput::make('sku')
                    ->label('SKU'),
                TextInput::make('regular_price'),
                TextInput::make('sale_price'),
                TextInput::make('date_on_sale_from'),
                TextInput::make('date_on_sale_to'),
                TextInput::make('external_url')
                    ->url(),
                TextInput::make('low_stock_amount'),
                TextInput::make('weight'),
                TextInput::make('shipping_class'),
                TextInput::make('average_rating'),
                Select::make('stock_status')
                    ->options(ProductStockStatus::class),
                Textarea::make('price_html')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('short_description')
                    ->columnSpanFull(),
                Textarea::make('descriptions')
                    ->columnSpanFull(),
                Textarea::make('short_descriptions')
                    ->columnSpanFull(),
                Toggle::make('featured'),
                Toggle::make('on_sale'),
                Toggle::make('purchasable'),
                Toggle::make('virtual'),
                Toggle::make('downloadable'),
                Toggle::make('manage_stock'),
                Toggle::make('sold_individually'),
                Toggle::make('shipping_required'),
                Toggle::make('shipping_taxable'),
                Toggle::make('reviews_allowed'),
                Toggle::make('has_options'),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('total_sales')
                    ->numeric(),
                TextInput::make('stock_quantity')
                    ->numeric(),
                TextInput::make('shipping_class_id')
                    ->numeric(),
                TextInput::make('rating_count')
                    ->numeric(),
                TextInput::make('menu_order')
                    ->numeric(),
                TextInput::make('parent_id')
                    ->numeric(),
            ]);
    }
}
