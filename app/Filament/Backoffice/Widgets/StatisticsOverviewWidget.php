<?php

namespace App\Filament\Backoffice\Widgets;

use App\Models\News;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Announcement;
use App\Models\Agenda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatisticsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('News Articles', News::count())
                ->description('Total news articles')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('primary'),

            Stat::make('Announcements', Announcement::count())
                ->description('Total announcements')
                ->descriptionIcon('heroicon-o-megaphone')
                ->color('success'),

            Stat::make('Agendas', Agenda::count())
                ->description('Total agendas')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('warning'),

            Stat::make('Pages', Page::count())
                ->description('Total pages')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),

            Stat::make('Categories', Category::count())
                ->description('Content categories')
                ->descriptionIcon('heroicon-o-tag')
                ->color('danger'),

            Stat::make('Media Items', Gallery::count())
                ->description('Gallery items')
                ->descriptionIcon('heroicon-o-photo')
                ->color('gray'),
        ];
    }
}