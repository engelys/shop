<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\CategoryDisplay;
use Filament\Resources\Resource;
use App\Filament\Resources\CategoryResource\Pages;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('slug')->disabled(),

                Forms\Components\Textarea::make('description'),
                Forms\Components\ToggleButtons::make('display')
                    ->inline()
                    ->grouped()
                    ->options(CategoryDisplay::class),

                Forms\Components\Select::make('parent_id')
                    ->relationship(name: 'parent', titleAttribute: 'name', ignoreRecord: true)
                    ->optionsLimit(10)
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('display')
                    ->label('Display')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('count')
                    ->label('Count')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('display')
                    ->options(CategoryDisplay::class)
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
