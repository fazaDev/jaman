<?php

namespace App\Filament\Backoffice\Resources\Sliders\Pages;

use App\Filament\Backoffice\Resources\Sliders\SliderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSliders extends ListRecords
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
