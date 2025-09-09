<?php

namespace App\Filament\Backoffice\Resources\Sliders\Schemas;

use App\Models\Slider;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slider Content')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                            ]),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        FileUpload::make('image_path')
                            ->label('Slider Image (Local Storage Only)')
                            ->image()
                            ->disk('public')
                            ->directory('sliders')
                            ->visibility('public')
                            ->required()
                            ->columnSpanFull()
                            ->acceptsFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->maxSize(5120) // 5MB max
                            ->helperText('Upload an image for the slider (recommended: 1200x600px, max 5MB). Only local storage images will be displayed.'),
                    ]),

                Section::make('Button Settings')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('button_text')
                                    ->maxLength(255)
                                    ->placeholder('e.g., Learn More'),

                                TextInput::make('button_url')
                                    // ->url()
                                    ->placeholder('https://example.com'),

                                Toggle::make('button_new_tab')
                                    ->label('Open in new tab')
                                    ->default(false),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Display Settings')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->options(Slider::getStatusOptions())
                                    ->default('active')
                                    ->required(),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower numbers appear first'),
                            ]),
                    ]),

                Section::make('Advanced Settings')
                    ->schema([
                        Repeater::make('settings')
                            ->schema([
                                Select::make('overlay_opacity')
                                    ->label('Overlay Opacity')
                                    ->options([
                                        '0' => '0% (No overlay)',
                                        '0.1' => '10%',
                                        '0.2' => '20%',
                                        '0.3' => '30%',
                                        '0.4' => '40%',
                                        '0.5' => '50%',
                                        '0.6' => '60%',
                                        '0.7' => '70%',
                                    ])
                                    ->default('0.5'),

                                Select::make('text_position')
                                    ->label('Text Position')
                                    ->options([
                                        'left' => 'Left',
                                        'center' => 'Center',
                                        'right' => 'Right',
                                    ])
                                    ->default('center'),

                                Select::make('animation_type')
                                    ->label('Animation Type')
                                    ->options([
                                        'fade' => 'Fade',
                                        'slide' => 'Slide',
                                        'zoom' => 'Zoom',
                                        'bounce' => 'Bounce',
                                    ])
                                    ->default('fade'),
                            ])
                            ->defaultItems(1)
                            ->collapsed()
                            ->itemLabel('Slider Settings')
                            ->deletable(false)
                            ->addable(false)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
