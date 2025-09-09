<?php

namespace App\Filament\Backoffice\Resources\News\Pages;

use App\Filament\Backoffice\Resources\News\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete News Article')
                ->modalDescription('Are you sure you want to delete this news article? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit News Article';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Set published_at when status changes to published
        if ($data['status'] === 'published' && 
            $this->record->status !== 'published' && 
            empty($data['published_at'])) {
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

    protected function getSavedNotificationTitle(): ?string
    {
        return 'News article updated successfully!';
    }
}