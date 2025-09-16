<?php

namespace App\Filament\Backoffice\Resources\Announcements\Tables;

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

class AnnouncementTable
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
                        'warning' => 'archived',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-check-circle' => 'published',
                        'heroicon-o-archive-box' => 'archived',
                    ])
                    ->searchable(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Expires')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(\App\Models\Announcement::getStatusOptions()),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),

                Filter::make('published')
                    ->label('Published')
                    ->query(fn (Builder $query): Builder => $query->published()),

                Filter::make('expired')
                    ->label('Expired')
                    ->query(fn (Builder $query): Builder => $query->where('expires_at', '<=', now())),
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
            ->defaultSort('published_at', 'desc');
    }
}