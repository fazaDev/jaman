<?php

namespace App\Filament\Backoffice\Resources\Galleries\Tables;

use App\Models\Gallery;
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

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->size(60)
                    ->square()
                    ->getStateUsing(function (Gallery $record) {
                        if ($record->type === 'video' && $record->thumbnail_path) {
                            return $record->thumbnail_path;
                        }
                        return $record->file_path;
                    }),
                    
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Gallery $record): string => 
                        $record->description ? \Illuminate\Support\Str::limit($record->description, 50) : ''
                    )
                    ->weight('medium'),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'success' => 'image',
                        'primary' => 'video',
                    ])
                    ->icons([
                        'heroicon-o-photo' => 'image',
                        'heroicon-o-video-camera' => 'video',
                    ]),

                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->placeholder('No category'),

                TextColumn::make('tags')
                    ->label('Tags')
                    ->badge()
                    ->color('info')
                    ->separator(',')
                    ->limit(3)
                    ->placeholder('No tags'),

                TextColumn::make('metadata')
                    ->label('Details')
                    ->getStateUsing(function (Gallery $record) {
                        $details = [];
                        
                        if ($record->metadata) {
                            $metadata = is_string($record->metadata) 
                                ? json_decode($record->metadata, true) 
                                : $record->metadata;
                                
                            if (isset($metadata['width']) && isset($metadata['height'])) {
                                $details[] = $metadata['width'] . 'x' . $metadata['height'];
                            }
                            
                            if (isset($metadata['duration']) && $record->type === 'video') {
                                $minutes = floor($metadata['duration'] / 60);
                                $seconds = $metadata['duration'] % 60;
                                $details[] = sprintf('%dm %ds', $minutes, $seconds);
                            }
                            
                            if (isset($metadata['file_size'])) {
                                $details[] = $metadata['file_size'] . 'MB';
                            }
                        }
                        
                        return implode(' • ', $details);
                    })
                    ->placeholder('No details'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->alignCenter(),

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
                SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'image' => 'Images',
                        'video' => 'Videos',
                    ])
                    ->placeholder('All Types'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->placeholder('All Statuses'),

                SelectFilter::make('category')
                    ->label('Category')
                    ->options(function () {
                        return Gallery::whereNotNull('category')
                            ->distinct()
                            ->pluck('category', 'category')
                            ->toArray();
                    })
                    ->placeholder('All Categories'),

                Filter::make('has_tags')
                    ->label('Has Tags')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('tags')),
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
            ->defaultSort('sort_order', 'asc')
            ->poll('30s')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}