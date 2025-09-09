<?php

namespace App\Filament\Backoffice\Resources\Galleries;

use App\Filament\Backoffice\Resources\Galleries\Pages\CreateGallery;
use App\Filament\Backoffice\Resources\Galleries\Pages\EditGallery;
use App\Filament\Backoffice\Resources\Galleries\Pages\ListGalleries;
use App\Filament\Backoffice\Resources\Galleries\Schemas\GalleryForm;
use App\Filament\Backoffice\Resources\Galleries\Tables\GalleriesTable;
use App\Models\Gallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    
    protected static ?string $navigationLabel = 'Gallery';
    
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'Media Management';
    }

    public static function form(Schema $schema): Schema
    {
        return GalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleriesTable::configure($table);
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
            'index' => ListGalleries::route('/'),
            'create' => CreateGallery::route('/create'),
            'edit' => EditGallery::route('/{record}/edit'),
        ];
    }
}