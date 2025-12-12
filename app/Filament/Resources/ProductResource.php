<?php

namespace App\Filament\Resources;

use App\Enums\ProductStatus;
use App\Enums\ProductStockStatus;
use App\Enums\ProductType;
use App\Filament\Resources\ProductResource\Pages;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('slug')->readOnly(),

            Forms\Components\TextInput::make('type'),
            Forms\Components\TextInput::make('status'),
            Forms\Components\TextInput::make('catalog_visibility'),

            Forms\Components\Textarea::make('description'),
            Forms\Components\Textarea::make('short_description'),

            Forms\Components\TextInput::make('sku'),

            Forms\Components\TextInput::make('price'),
            Forms\Components\TextInput::make('regular_price'),
            Forms\Components\TextInput::make('sale_price'),
            Forms\Components\Toggle::make('on_sale'),
            Forms\Components\Toggle::make('purchasable'),
            Forms\Components\Toggle::make('virtual'),
            Forms\Components\Toggle::make('downloadable'),

            Forms\Components\Toggle::make('manage_stock'),
            Forms\Components\TextInput::make('stock_quantity'),
            Forms\Components\TextInput::make('stock_status'),
            Forms\Components\TextInput::make('low_stock_amount'),
            Forms\Components\Toggle::make('sold_individually'),
            Forms\Components\Toggle::make('has_options'),

            Forms\Components\TextInput::make('parent_id'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock_status')
                    ->label('In Stock')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(ProductType::class),

                Tables\Filters\SelectFilter::make('status')
                    ->options(ProductStatus::class),

                Tables\Filters\SelectFilter::make('stock_status')
                    ->options(ProductStockStatus::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
