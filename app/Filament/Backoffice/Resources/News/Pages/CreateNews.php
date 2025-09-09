<?php

namespace App\Filament\Backoffice\Resources\News\Pages;

use App\Filament\Backoffice\Resources\News\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    public function getTitle(): string
    {
        return 'Create New News Article';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set author to current user if not set
        if (empty($data['author_id'])) {
            $data['author_id'] = auth()->id();
        }

        // Set published_at if status is published and no date is set
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // Clean up meta_data
        if (isset($data['meta_data']) && is_array($data['meta_data'])) {
            $data['meta_data'] = array_filter($data['meta_data'], function ($value) {
                return $value !== null && $value !== '';
            });
        }

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'News article created successfully!';
    }
}