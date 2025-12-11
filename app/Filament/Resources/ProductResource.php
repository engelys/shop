<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;

// use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // translatable
            Forms\Components\TextInput::make('data.name'),
            // auto filled unique slug from name
            Forms\Components\TextInput::make('data.slug')->readOnly(),

            Forms\Components\TextInput::make('data.type'),
            Forms\Components\TextInput::make('data.status'),
            Forms\Components\TextInput::make('data.catalog_visibility'),

            Forms\Components\Textarea::make('data.description'),
            Forms\Components\Textarea::make('data.short_description'),

            Forms\Components\TextInput::make('data.sku'),

            Forms\Components\TextInput::make('data.price'),
            Forms\Components\TextInput::make('data.regular_price'),
            Forms\Components\TextInput::make('data.sale_price'),
            Forms\Components\Toggle::make('data.on_sale'),
            Forms\Components\Toggle::make('data.purchasable'),
            Forms\Components\Toggle::make('data.virtual'),
            Forms\Components\Toggle::make('data.downloadable'),

            Forms\Components\Toggle::make('data.manage_stock'),
            Forms\Components\TextInput::make('data.stock_quantity'),
            Forms\Components\TextInput::make('data.stock_status'),
            Forms\Components\TextInput::make('data.low_stock_amount'),
            Forms\Components\Toggle::make('data.sold_individually'),
            Forms\Components\Toggle::make('data.has_options'),

            Forms\Components\TextInput::make('data.parent_id'),
            Forms\Components\TextInput::make('data.categories'),
            Forms\Components\TextInput::make('data.tags'),
            Forms\Components\TextInput::make('data.images'),
            Forms\Components\TextInput::make('data.attributes'),
            Forms\Components\TextInput::make('data.default_attributes'),
            Forms\Components\TextInput::make('data.variations'),
            Forms\Components\TextInput::make('data.related_ids'),

            Forms\Components\TextInput::make('data.menu_order'),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data.name')->label('Name'),
                // auto filled unique slug from name
                Tables\Columns\TextColumn::make('data.slug')->label('Slug'),

                Tables\Columns\TextColumn::make('data.type')->label('Type'),
                Tables\Columns\TextColumn::make('data.status')->label('Status'),
            ])
            ->filters([
                //
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
