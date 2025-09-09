<?php

namespace App\Filament\Backoffice\Resources\Categories\Schemas;

use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\ColorPicker;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Category Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter category name')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set, $context) {
                                        if ($context === 'create') {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('category-slug')
                                    ->unique(Category::class, 'slug', ignoreRecord: true)
                                    ->suffixAction(
                                        Action::make('regenerateSlug')
                                            ->icon('heroicon-o-arrow-path')
                                            ->action(function ($state, callable $set, callable $get) {
                                                $set('slug', Str::slug($get('name')));
                                            })
                                    ),
                            ]),

                        Textarea::make('description')
                            ->label('Description')
                            ->maxLength(1000)
                            ->placeholder('Enter category description')
                            ->rows(3),
                    ]),

                Section::make('Display Settings')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ColorPicker::make('color')
                                    ->label('Color')
                                    ->default('#3b82f6')
                                    ->placeholder('#3b82f6'),

                                TextInput::make('icon')
                                    ->label('Icon')
                                    ->placeholder('heroicon-o-tag')
                                    ->helperText('Use Heroicon class names (e.g., heroicon-o-tag)'),

                                Select::make('status')
                                    ->label('Status')
                                    ->required()
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                    ])
                                    ->default('active'),
                            ]),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Lower numbers appear first'),
                    ]),
            ]);
    }
}