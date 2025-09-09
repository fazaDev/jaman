<?php

namespace App\Filament\Backoffice\Resources\Categories;

use App\Filament\Backoffice\Resources\Categories\Pages\CreateCategory;
use App\Filament\Backoffice\Resources\Categories\Pages\EditCategory;
use App\Filament\Backoffice\Resources\Categories\Pages\ListCategories;
use App\Filament\Backoffice\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Backoffice\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;
    
    protected static ?string $navigationLabel = 'Categories';
    
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'Content Management';
    }

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}