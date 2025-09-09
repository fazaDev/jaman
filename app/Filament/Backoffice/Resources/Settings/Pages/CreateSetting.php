<?php

namespace App\Filament\Backoffice\Resources\Settings\Pages;

use App\Filament\Backoffice\Resources\Settings\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    public function getTitle(): string
    {
        return 'Add New Setting';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Convert boolean values to string for storage
        if ($data['type'] === 'boolean') {
            $data['value'] = $data['value'] ? 'true' : 'false';
        }

        // Handle JSON validation
        if ($data['type'] === 'json' && !empty($data['value'])) {
            $decoded = json_decode($data['value'], true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format provided.');
            }
        }

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Setting created successfully!';
    }
}