<?php

namespace App\Filament\Backoffice\Resources\Agendas;

use App\Filament\Backoffice\Resources\Agendas\Pages\CreateAgenda;
use App\Filament\Backoffice\Resources\Agendas\Pages\EditAgenda;
use App\Filament\Backoffice\Resources\Agendas\Pages\ListAgendas;
use App\Filament\Backoffice\Resources\Agendas\Schemas\AgendaForm;
use App\Filament\Backoffice\Resources\Agendas\Tables\AgendaTable;
use App\Models\Agenda;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;
    
    protected static ?string $navigationLabel = 'Agendas';
    
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return 'Content Management';
    }

    public static function form(Schema $schema): Schema
    {
        return AgendaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgendaTable::configure($table);
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
            'index' => ListAgendas::route('/'),
            'create' => CreateAgenda::route('/create'),
            'edit' => EditAgenda::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function canAccess(): bool
    {
        return true;
    }

    public static function getModelLabel(): string
    {
        return 'Agenda';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Agendas';
    }
}