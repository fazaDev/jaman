<?php

namespace App\Filament\Backoffice\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Page $record): string => $record->parent ? "Child of: {$record->parent->title}" : ''),
                    
                TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug copied')
                    ->fontFamily('mono'),
                    
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => Page::getStatusOptions()[$state] ?? $state)
                    ->sortable(),
                    
                TextColumn::make('parent.title')
                    ->label('Parent Page')
                    ->default('—')
                    ->searchable(),
                    
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                    
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),
                    
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(Page::getStatusOptions()),
                    
                SelectFilter::make('parent_id')
                    ->label('Parent Page')
                    ->options(Page::whereNull('parent_id')->pluck('title', 'id'))
                    ->placeholder('All pages'),
                    
                SelectFilter::make('is_featured')
                    ->label('Featured')
                    ->options([
                        1 => 'Featured',
                        0 => 'Not Featured',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn (Page $record): string => '/' . $record->slug)
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }
}
