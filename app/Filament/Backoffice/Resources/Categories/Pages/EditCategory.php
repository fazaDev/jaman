<?php

namespace App\Filament\Backoffice\Resources\Categories\Pages;

use App\Filament\Backoffice\Resources\Categories\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Category')
                ->modalDescription('Are you sure you want to delete this category? This action cannot be undone and may affect related news articles.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Category';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Category updated successfully!';
    }
}