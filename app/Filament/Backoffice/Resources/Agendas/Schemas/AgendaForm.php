<?php

namespace App\Filament\Backoffice\Resources\Agendas\Schemas;

use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->schema([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('agendas'),

                        TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255),
                    ]),

                Section::make('Schedule')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('start_date')
                            ->label('Start Date')
                            ->native(false)
                            ->required(),

                        DateTimePicker::make('end_date')
                            ->label('End Date')
                            ->native(false),
                    ]),

                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(\App\Models\Agenda::getStatusOptions())
                            ->default('draft')
                            ->required(),

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),
                    ]),

                Section::make('SEO')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160),

                        TagsInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->separator(','),
                    ]),
            ]);
    }
}