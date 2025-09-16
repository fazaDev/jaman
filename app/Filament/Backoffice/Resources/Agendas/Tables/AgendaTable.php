<?php

namespace App\Filament\Backoffice\Resources\Agendas\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AgendaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                        'warning' => 'cancelled',
                        'info' => 'completed',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-check-circle' => 'published',
                        'heroicon-o-x-circle' => 'cancelled',
                        'heroicon-o-flag' => 'completed',
                    ])
                    ->searchable(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(\App\Models\Agenda::getStatusOptions()),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Filter::make('upcoming')
                    ->label('Upcoming')
                    ->query(fn (Builder $query): Builder => $query->upcoming()),

                Filter::make('past')
                    ->label('Past')
                    ->query(fn (Builder $query): Builder => $query->past()),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
    }
}