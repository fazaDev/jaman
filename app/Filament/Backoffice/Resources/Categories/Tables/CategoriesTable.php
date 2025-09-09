<?php

namespace App\Filament\Backoffice\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ColorColumn::make('color')
                    ->label('Color'),
                    
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Category $record): string => 
                        $record->description ? \Illuminate\Support\Str::limit($record->description, 50) : ''
                    )
                    ->weight('medium'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->color('gray'),

                TextColumn::make('icon')
                    ->label('Icon')
                    ->fontFamily('mono')
                    ->color('gray')
                    ->placeholder('No icon'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),

                TextColumn::make('news_count')
                    ->label('News Count')
                    ->getStateUsing(fn (Category $record) => $record->news()->count())
                    ->badge()
                    ->color('primary')
                    ->alignCenter(),

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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->placeholder('All Statuses'),
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