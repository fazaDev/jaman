<?php

namespace App\Filament\Backoffice\Resources\Settings\Pages;

use App\Filament\Backoffice\Resources\Settings\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Delete Setting')
                ->modalDescription('Are you sure you want to delete this setting? This action cannot be undone and may affect website functionality.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    public function getTitle(): string
    {
        return 'Edit Setting';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Convert string boolean back to boolean for form display
        if ($data['type'] === 'boolean') {
            $data['value'] = $data['value'] === 'true';
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Setting updated successfully!';
    }
}