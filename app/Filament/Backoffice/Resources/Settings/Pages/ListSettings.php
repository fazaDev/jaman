<?php

namespace App\Filament\Backoffice\Resources\Settings\Pages;

use App\Filament\Backoffice\Resources\Settings\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Setting')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'System Settings';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}