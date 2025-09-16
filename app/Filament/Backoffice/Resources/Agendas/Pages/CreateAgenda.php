<?php

namespace App\Filament\Backoffice\Resources\Agendas\Pages;

use App\Filament\Backoffice\Resources\Agendas\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgenda extends CreateRecord
{
    protected static string $resource = AgendaResource::class;

    public function getTitle(): string
    {
        return 'Create New Agenda';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
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
        return 'Agenda created successfully!';
    }
}