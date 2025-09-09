<?php

namespace App\Filament\Backoffice\Resources\Settings\Tables;

use App\Models\Setting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Setting Key')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->copyable()
                    ->fontFamily('mono'),

                TextColumn::make('value')
                    ->label('Value')
                    ->limit(50)
                    ->tooltip(function (Setting $record): string {
                        return $record->value ?? 'No value';
                    })
                    ->getStateUsing(function (Setting $record) {
                        if ($record->type === 'boolean') {
                            return $record->value === 'true' ? 'Enabled' : 'Disabled';
                        }
                        if ($record->type === 'file') {
                            return $record->value ? basename($record->value) : 'No file';
                        }
                        return $record->value ?? 'No value';
                    }),

                BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'text',
                        'success' => 'boolean',
                        'warning' => 'number',
                        'info' => 'textarea',
                        'danger' => 'file',
                        'secondary' => 'json',
                    ]),

                TextColumn::make('group')
                    ->label('Group')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No group'),

                IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean()
                    ->trueIcon('heroicon-o-globe-alt')
                    ->falseIcon('heroicon-o-lock-closed')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->tooltip(fn (Setting $record) => $record->is_public ? 'Public access enabled' : 'Private setting'),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(40)
                    ->tooltip(function (Setting $record): string {
                        return $record->description ?? 'No description';
                    })
                    ->placeholder('No description')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                    ->options(Setting::getTypes())
                    ->placeholder('All Types'),

                SelectFilter::make('group')
                    ->label('Group')
                    ->options(Setting::getGroups())
                    ->placeholder('All Groups'),

                SelectFilter::make('is_public')
                    ->label('Access')
                    ->options([
                        '1' => 'Public',
                        '0' => 'Private',
                    ])
                    ->placeholder('All Settings'),
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
            ->defaultSort('group', 'asc')
            ->defaultSort('sort_order', 'asc')
            ->poll('30s')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->groups([
                'group' => 'Group',
            ]);
    }
}