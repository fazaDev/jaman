<?php

namespace App\Filament\Backoffice\Resources\Galleries\Pages;

use App\Filament\Backoffice\Resources\Galleries\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    public function getTitle(): string
    {
        return 'Add New Gallery Item';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-generate metadata based on uploaded file if not provided
        if (empty($data['metadata']) || !is_array($data['metadata'])) {
            $data['metadata'] = [];
        }

        // Clean up null values from metadata
        $data['metadata'] = array_filter($data['metadata'], function ($value) {
            return $value !== null && $value !== '';
        });

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Gallery item created successfully!';
    }
}