<?php

namespace App\Filament\Backoffice\Resources\Galleries\Pages;

use App\Filament\Backoffice\Resources\Galleries\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGallery extends EditRecord
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Gallery Item')
                ->modalDescription('Are you sure you want to delete this gallery item? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Gallery Item';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Clean up metadata before saving
        if (isset($data['metadata']) && is_array($data['metadata'])) {
            $data['metadata'] = array_filter($data['metadata'], function ($value) {
                return $value !== null && $value !== '';
            });
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Gallery item updated successfully!';
    }
}