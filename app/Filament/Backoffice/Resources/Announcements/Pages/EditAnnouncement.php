<?php

namespace App\Filament\Backoffice\Resources\Announcements\Pages;

use App\Filament\Backoffice\Resources\Announcements\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnouncement extends EditRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Announcement')
                ->modalDescription('Are you sure you want to delete this announcement? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Announcement';
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
        return 'Announcement updated successfully!';
    }
}