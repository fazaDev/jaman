<?php

namespace App\Filament\Backoffice\Resources\Galleries\Schemas;

use App\Models\Gallery;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter gallery item title'),

                                Select::make('type')
                                    ->label('Type')
                                    ->required()
                                    ->options([
                                        'image' => 'Image',
                                        'video' => 'Video',
                                    ])
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if ($state === 'image') {
                                            $set('thumbnail_path', null);
                                        }
                                    }),
                            ]),

                        Textarea::make('description')
                            ->label('Description')
                            ->maxLength(1000)
                            ->placeholder('Enter description for this gallery item')
                            ->rows(3),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('category')
                                    ->label('Category')
                                    ->placeholder('e.g., Portfolio, Team, Events')
                                    ->datalist([
                                        'Portfolio',
                                        'Team',
                                        'Events',
                                        'Products',
                                        'Office',
                                        'Awards',
                                        'News',
                                    ]),

                                TagsInput::make('tags')
                                    ->label('Tags')
                                    ->placeholder('Add tags for better organization')
                                    ->suggestions([
                                        'featured',
                                        'homepage',
                                        'banner',
                                        'showcase',
                                        'testimonial',
                                        'project',
                                        'achievement',
                                    ]),
                            ]),
                    ]),

                Section::make('Media Files')
                    ->schema([
                        FileUpload::make('file_path')
                            ->label('Main File')
                            ->required()
                            ->disk('public')
                            ->directory('gallery')
                            ->acceptedFileTypes(function (callable $get) {
                                $type = $get('type');
                                if ($type === 'image') {
                                    return ['image/*'];
                                } elseif ($type === 'video') {
                                    return ['video/*'];
                                }
                                return ['image/*', 'video/*'];
                            })
                            ->maxSize(102400) // 100MB
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio(null)
                            ->imageResizeTargetWidth(1920)
                            ->imageResizeTargetHeight(1080)
                            ->columnSpanFull(),

                        FileUpload::make('thumbnail_path')
                            ->label('Thumbnail (Required for Videos)')
                            ->disk('public')
                            ->directory('gallery/thumbnails')
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(5120) // 5MB
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth(640)
                            ->imageResizeTargetHeight(360)
                            ->visible(fn (callable $get) => $get('type') === 'video')
                            ->columnSpanFull(),

                        TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->placeholder('Describe the image/video for accessibility')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Metadata & Settings')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('status')
                                    ->label('Status')
                                    ->required()
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                    ])
                                    ->default('active'),

                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),

                                TextInput::make('metadata.duration')
                                    ->label('Video Duration (seconds)')
                                    ->numeric()
                                    ->visible(fn (callable $get) => $get('type') === 'video')
                                    ->placeholder('e.g., 120'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('metadata.width')
                                    ->label('Width (px)')
                                    ->numeric()
                                    ->placeholder('e.g., 1920'),

                                TextInput::make('metadata.height')
                                    ->label('Height (px)')
                                    ->numeric()
                                    ->placeholder('e.g., 1080'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('metadata.file_size')
                                    ->label('File Size (MB)')
                                    ->numeric()
                                    ->step(0.1)
                                    ->placeholder('e.g., 15.5'),

                                TextInput::make('metadata.format')
                                    ->label('File Format')
                                    ->placeholder('e.g., JPEG, MP4, PNG')
                                    ->maxLength(50),
                            ]),
                    ]),
            ]);
    }
}