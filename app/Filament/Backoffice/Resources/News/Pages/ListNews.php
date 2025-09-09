<?php

namespace App\Filament\Backoffice\Resources\News\Pages;

use App\Filament\Backoffice\Resources\News\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNews extends ListRecords
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create News')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'News Management';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}