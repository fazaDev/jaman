<?php

namespace App\Filament\Backoffice\Resources\Settings;

use App\Filament\Backoffice\Resources\Settings\Pages\CreateSetting;
use App\Filament\Backoffice\Resources\Settings\Pages\EditSetting;
use App\Filament\Backoffice\Resources\Settings\Pages\ListSettings;
use App\Filament\Backoffice\Resources\Settings\Schemas\SettingForm;
use App\Filament\Backoffice\Resources\Settings\Tables\SettingsTable;
use App\Models\Setting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    
    protected static ?string $navigationLabel = 'Settings';
    
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return 'System Management';
    }

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
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
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}