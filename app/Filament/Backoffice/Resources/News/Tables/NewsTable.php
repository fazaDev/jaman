<?php

namespace App\Filament\Backoffice\Resources\News\Tables;

use App\Models\News;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->size(60)
                    ->square()
                    ->placeholder('No image'),
                    
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (News $record): string => 
                        $record->excerpt ? \Illuminate\Support\Str::limit($record->excerpt, 50) : 
                        \Illuminate\Support\Str::limit(strip_tags($record->content), 50)
                    )
                    ->weight('medium')
                    ->wrap(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color(fn (News $record) => match($record->category?->slug) {
                        'berita-utama' => 'danger',
                        'pengumuman' => 'primary',
                        'kegiatan' => 'success',
                        'prestasi' => 'warning',
                        'teknologi' => 'purple',
                        'program' => 'info',
                        'kerjasama' => 'lime',
                        'edukasi' => 'orange',
                        default => 'gray'
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ])
                    ->icons([
                        'heroicon-o-document' => 'draft',
                        'heroicon-o-eye' => 'published',
                        'heroicon-o-archive-box' => 'archived',
                    ]),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->numeric()
                    ->badge()
                    ->color('primary')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('tags')
                    ->label('Tags')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->limit(2)
                    ->placeholder('No tags')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime('M j, Y H:i')
                    ->sortable()
                    ->placeholder('Not published')
                    ->color(fn (News $record) => $record->published_at?->isFuture() ? 'warning' : 'success'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M j, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->placeholder('All Statuses'),

                SelectFilter::make('category')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Categories'),

                SelectFilter::make('author')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Authors'),

                Filter::make('is_featured')
                    ->label('Featured Only')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true)),

                Filter::make('published_today')
                    ->label('Published Today')
                    ->query(fn (Builder $query): Builder => $query->whereDate('published_at', today())),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}