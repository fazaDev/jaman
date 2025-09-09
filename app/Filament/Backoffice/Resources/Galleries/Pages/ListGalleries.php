<?php

namespace App\Filament\Backoffice\Resources\Galleries\Pages;

use App\Filament\Backoffice\Resources\Galleries\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Gallery Item')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Gallery Management';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}