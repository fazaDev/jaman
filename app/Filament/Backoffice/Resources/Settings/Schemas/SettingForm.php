<?php

namespace App\Filament\Backoffice\Resources\Settings\Schemas;

use App\Models\Setting;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('key')
                                    ->label('Setting Key')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., site_name')
                                    ->unique(Setting::class, 'key', ignoreRecord: true)
                                    ->helperText('Unique identifier for this setting'),

                                Select::make('type')
                                    ->label('Value Type')
                                    ->required()
                                    ->options(Setting::getTypes())
                                    ->default('text')
                                    ->reactive(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('group')
                                    ->label('Group')
                                    ->options(Setting::getGroups())
                                    ->placeholder('Select a group')
                                    ->searchable(),

                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Lower numbers appear first'),
                            ]),

                        Textarea::make('description')
                            ->label('Description')
                            ->maxLength(1000)
                            ->placeholder('Describe what this setting controls')
                            ->rows(2),
                    ]),

                Section::make('Setting Value')
                    ->schema([
                        TextInput::make('value')
                            ->label('Value')
                            ->placeholder('Enter the setting value')
                            ->visible(fn (callable $get) => in_array($get('type'), ['text', 'number']))
                            ->numeric(fn (callable $get) => $get('type') === 'number'),

                        Textarea::make('value')
                            ->label('Value')
                            ->placeholder('Enter the setting value')
                            ->rows(4)
                            ->visible(fn (callable $get) => in_array($get('type'), ['textarea', 'json']))
                            ->helperText(fn (callable $get) => $get('type') === 'json' ? 'Enter valid JSON format' : ''),

                        Toggle::make('value')
                            ->label('Value')
                            ->visible(fn (callable $get) => $get('type') === 'boolean')
                            ->helperText('Toggle to enable/disable this setting'),

                        FileUpload::make('value')
                            ->label('File')
                            ->disk('public')
                            ->directory('settings')
                            ->acceptedFileTypes(['image/*', 'application/pdf', '.doc', '.docx'])
                            ->maxSize(5120) // 5MB
                            ->visible(fn (callable $get) => $get('type') === 'file')
                            ->helperText('Upload file for this setting'),
                    ]),

                Section::make('Access Control')
                    ->schema([
                        Toggle::make('is_public')
                            ->label('Public Access')
                            ->helperText('Allow frontend access to this setting')
                            ->default(false),
                    ]),
            ]);
    }
}