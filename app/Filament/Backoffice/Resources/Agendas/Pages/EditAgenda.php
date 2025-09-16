<?php

namespace App\Filament\Backoffice\Resources\Agendas\Pages;

use App\Filament\Backoffice\Resources\Agendas\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgenda extends EditRecord
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Agenda')
                ->modalDescription('Are you sure you want to delete this agenda? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Agenda';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
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
        return 'Agenda updated successfully!';
    }
}