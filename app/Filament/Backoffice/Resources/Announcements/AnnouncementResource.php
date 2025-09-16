<?php

namespace App\Filament\Backoffice\Resources\Announcements;

use App\Filament\Backoffice\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Backoffice\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Backoffice\Resources\Announcements\Pages\ListAnnouncements;
use App\Filament\Backoffice\Resources\Announcements\Schemas\AnnouncementForm;
use App\Filament\Backoffice\Resources\Announcements\Tables\AnnouncementTable;
use App\Models\Announcement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;
    
    protected static ?string $navigationLabel = 'Announcements';
    
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return 'Content Management';
    }

    public static function form(Schema $schema): Schema
    {
        return AnnouncementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnnouncementTable::configure($table);
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
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function canAccess(): bool
    {
        return true;
    }

    public static function getModelLabel(): string
    {
        return 'Announcement';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Announcements';
    }
}