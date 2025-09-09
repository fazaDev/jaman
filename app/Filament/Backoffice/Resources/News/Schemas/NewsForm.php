<?php

namespace App\Filament\Backoffice\Resources\News\Schemas;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;

class NewsForm
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
                                    ->placeholder('Enter news title')
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
                                    ->placeholder('news-slug')
                                    ->unique(News::class, 'slug', ignoreRecord: true)
                                    ->suffixAction(
                                        Action::make('regenerateSlug')
                                            ->icon('heroicon-o-arrow-path')
                                            ->action(function ($state, callable $set, callable $get) {
                                                $set('slug', Str::slug($get('title')));
                                            })
                                    ),
                            ]),

                        Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->maxLength(500)
                            ->placeholder('Brief summary of the news article')
                            ->rows(3),

                        RichEditor::make('content')
                            ->label('Content')
                            ->required()
                            ->placeholder('Write the full news content here...')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media & Categorization')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->directory('news')
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(5120) // 5MB
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth(1200)
                            ->imageResizeTargetHeight(675),

                        TextInput::make('featured_image_alt')
                            ->label('Image Alt Text')
                            ->placeholder('Describe the image for accessibility')
                            ->maxLength(255),

                        Grid::make(2)
                            ->schema([
                                Select::make('category_id')
                                    ->label('Category')
                                    ->required()
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload(),

                                Select::make('author_id')
                                    ->label('Author')
                                    ->required()
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->default(auth()->id()),
                            ]),

                        TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Add tags for better searchability')
                            ->suggestions([
                                'breaking news',
                                'infrastructure',
                                'technology',
                                'construction',
                                'government',
                                'policy',
                                'development',
                                'innovation',
                            ]),
                    ]),

                Section::make('Publication Settings')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Select::make('status')
                                    ->label('Status')
                                    ->required()
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->reactive(),

                                Toggle::make('is_featured')
                                    ->label('Featured Article')
                                    ->helperText('Show this article prominently on homepage'),

                                Toggle::make('allow_comments')
                                    ->label('Allow Comments')
                                    ->default(true),
                            ]),

                        DateTimePicker::make('published_at')
                            ->label('Publish Date & Time')
                            ->placeholder('Leave empty for immediate publishing')
                            ->visible(fn (callable $get) => $get('status') === 'published'),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('Lower numbers appear first'),

                                TextInput::make('views_count')
                                    ->label('Views Count')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),
                    ]),

                Section::make('SEO Settings')
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_data.meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->placeholder('SEO title for search engines'),

                        Textarea::make('meta_data.meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->placeholder('Brief description for search engine results')
                            ->rows(2),

                        TextInput::make('meta_data.keywords')
                            ->label('SEO Keywords')
                            ->placeholder('keyword1, keyword2, keyword3'),
                    ]),
            ]);
    }
}