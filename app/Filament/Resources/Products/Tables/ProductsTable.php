<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enums\ProductStockStatus;
use App\Enums\ProductType;
use Filament\Actions;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->defaultImageUrl(fn($record) => $record->main_image()),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('stock_status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->money('UAH')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('categories.name')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('stock_status')
                    ->options(ProductStockStatus::class),
                SelectFilter::make('type')
                    ->options(ProductType::class)
            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filtersLayout(FiltersLayout::AboveContent);
    }
}
