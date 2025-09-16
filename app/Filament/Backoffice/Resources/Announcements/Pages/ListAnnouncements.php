<?php

namespace App\Filament\Backoffice\Resources\Announcements\Pages;

use App\Filament\Backoffice\Resources\Announcements\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnnouncements extends ListRecords
{
    protected static string $resource = AnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Announcement')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Announcement Management';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}