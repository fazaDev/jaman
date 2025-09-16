<?php

namespace App\Filament\Backoffice\Resources\Announcements\Schemas;

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

class AnnouncementForm
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

                        RichEditor::make('content')
                            ->label('Content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('announcements'),

                        Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options(\App\Models\Announcement::getStatusOptions())
                            ->default('draft')
                            ->required(),

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->native(false),

                        DateTimePicker::make('expires_at')
                            ->label('Expiry Date')
                            ->native(false),
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