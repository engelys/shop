<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('permalink')
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('catalog_visibility')
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                TextColumn::make('regular_price')
                    ->searchable(),
                TextColumn::make('sale_price')
                    ->searchable(),
                TextColumn::make('date_on_sale_from')
                    ->searchable(),
                TextColumn::make('date_on_sale_to')
                    ->searchable(),
                TextColumn::make('external_url')
                    ->searchable(),
                TextColumn::make('low_stock_amount')
                    ->searchable(),
                TextColumn::make('weight')
                    ->searchable(),
                TextColumn::make('shipping_class')
                    ->searchable(),
                TextColumn::make('average_rating')
                    ->searchable(),
                TextColumn::make('stock_status')
                    ->badge()
                    ->searchable(),
                IconColumn::make('featured')
                    ->boolean(),
                IconColumn::make('on_sale')
                    ->boolean(),
                IconColumn::make('purchasable')
                    ->boolean(),
                IconColumn::make('virtual')
                    ->boolean(),
                IconColumn::make('downloadable')
                    ->boolean(),
                IconColumn::make('manage_stock')
                    ->boolean(),
                IconColumn::make('sold_individually')
                    ->boolean(),
                IconColumn::make('shipping_required')
                    ->boolean(),
                IconColumn::make('shipping_taxable')
                    ->boolean(),
                IconColumn::make('reviews_allowed')
                    ->boolean(),
                IconColumn::make('has_options')
                    ->boolean(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('total_sales')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping_class_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rating_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('menu_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
