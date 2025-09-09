<?php

namespace App\Filament\Backoffice\Resources\Sliders\Pages;

use App\Filament\Backoffice\Resources\Sliders\SliderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSlider extends EditRecord
{
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
