<?php

namespace App\Filament\Backoffice\Resources\Categories\Pages;

use App\Filament\Backoffice\Resources\Categories\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Category')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Category Management';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}