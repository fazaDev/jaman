<?php

namespace App\Filament\Backoffice\Resources\News;

use App\Filament\Backoffice\Resources\News\Pages\CreateNews;
use App\Filament\Backoffice\Resources\News\Pages\EditNews;
use App\Filament\Backoffice\Resources\News\Pages\ListNews;
use App\Filament\Backoffice\Resources\News\Schemas\NewsForm;
use App\Filament\Backoffice\Resources\News\Tables\NewsTable;
use App\Models\News;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;
    
    protected static ?string $navigationLabel = 'News';
    
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return 'Content Management';
    }

    public static function form(Schema $schema): Schema
    {
        return NewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsTable::configure($table);
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
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}