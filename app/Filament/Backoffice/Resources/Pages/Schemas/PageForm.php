<?php

namespace App\Filament\Backoffice\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Page Content')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $context, $state, callable $set) {
                                        if ($context === 'create') {
                                            $set('slug', \Illuminate\Support\Str::slug($state));
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Page::class, 'slug', ignoreRecord: true)
                                    ->rules(['alpha_dash'])
                                    ->helperText('URL-friendly version of the title')
                                    ->suffixAction(
                                        Action::make('regenerateSlug')
                                            ->icon('heroicon-m-arrow-path')
                                            ->action(function (callable $set, callable $get) {
                                                $title = $get('title');
                                                if ($title) {
                                                    $set('slug', \Illuminate\Support\Str::slug($title));
                                                }
                                            })
                                            ->tooltip('Regenerate slug from title')
                                    ),
                            ]),
                        
                        RichEditor::make('content')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                        
                        Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->maxLength(300)
                            ->rows(3)
                            ->helperText('Brief summary of the page content')
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->disk('public')
                            ->directory('pages')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Upload a featured image for this page'),
                            
                        TextInput::make('featured_image_alt')
                            ->label('Image Alt Text')
                            ->maxLength(255)
                            ->helperText('Describe the image for accessibility'),
                    ])
                    ->collapsible(),
                    
                Section::make('Page Settings')
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Select::make('status')
                                    ->options(Page::getStatusOptions())
                                    ->default('draft')
                                    ->required(),
                                    
                                Select::make('parent_id')
                                    ->label('Parent Page')
                                    ->options(Page::whereNull('parent_id')->pluck('title', 'id'))
                                    ->searchable()
                                    ->placeholder('Select parent page (optional)'),
                                    
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower numbers appear first'),
                            ]),
                            
                        Toggle::make('is_featured')
                            ->label('Featured Page')
                            ->helperText('Mark this page as featured'),
                    ]),
                    
                Section::make('SEO Settings')
                    ->schema([
                        Textarea::make('meta_description')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Brief description for search engines (max 160 characters)'),
                            
                        TextInput::make('meta_keywords')
                            ->helperText('Comma-separated keywords for SEO'),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
