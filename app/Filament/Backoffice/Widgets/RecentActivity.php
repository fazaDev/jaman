<?php

namespace App\Filament\Backoffice\Widgets;

use App\Models\News;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Announcement;
use App\Models\Agenda;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentActivity extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Activity')
            ->query(
                News::query()
                    ->union(Announcement::query()->select('*'))
                    ->union(Agenda::query()->select('*'))
                    ->union(Page::query()->select('*'))
                    ->union(Slider::query()->select('*'))
                    ->union(Gallery::query()->select('*'))
            )
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->getStateUsing(function ($record) {
                        return class_basename($record);
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->paginated([5]);
    }
}