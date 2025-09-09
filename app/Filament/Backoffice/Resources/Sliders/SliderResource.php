<?php

namespace App\Filament\Backoffice\Resources\Sliders;

use App\Filament\Backoffice\Resources\Sliders\Pages\CreateSlider;
use App\Filament\Backoffice\Resources\Sliders\Pages\EditSlider;
use App\Filament\Backoffice\Resources\Sliders\Pages\ListSliders;
use App\Filament\Backoffice\Resources\Sliders\Schemas\SliderForm;
use App\Filament\Backoffice\Resources\Sliders\Tables\SlidersTable;
use App\Models\Slider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    
    protected static ?string $navigationLabel = 'Sliders';
    
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'Media Management';
    }

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SliderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SlidersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}
