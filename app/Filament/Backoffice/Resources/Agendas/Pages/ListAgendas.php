<?php

namespace App\Filament\Backoffice\Resources\Agendas\Pages;

use App\Filament\Backoffice\Resources\Agendas\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgendas extends ListRecords
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Agenda')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTitle(): string
    {
        return 'Agenda Management';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}