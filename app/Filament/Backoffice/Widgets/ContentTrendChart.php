<?php

namespace App\Filament\Backoffice\Widgets;

use App\Models\News;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Announcement;
use App\Models\Agenda;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ContentTrendChart extends ChartWidget
{
    protected ?string $heading = 'Content Creation Trend (Last 30 Days)';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Generate last 30 days
        $dates = [];
        $newsData = [];
        $pageData = [];
        $sliderData = [];
        $galleryData = [];
        $announcementData = [];
        $agendaData = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('M d');
            
            $newsData[] = News::whereDate('created_at', $date)->count();
            $pageData[] = Page::whereDate('created_at', $date)->count();
            $sliderData[] = Slider::whereDate('created_at', $date)->count();
            $galleryData[] = Gallery::whereDate('created_at', $date)->count();
            $announcementData[] = Announcement::whereDate('created_at', $date)->count();
            $agendaData[] = Agenda::whereDate('created_at', $date)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'News',
                    'data' => $newsData,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => 'Pages',
                    'data' => $pageData,
                    'borderColor' => 'rgb(16, 185, 129)',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
                [
                    'label' => 'Sliders',
                    'data' => $sliderData,
                    'borderColor' => 'rgb(245, 158, 11)',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                ],
                [
                    'label' => 'Gallery',
                    'data' => $galleryData,
                    'borderColor' => 'rgb(139, 92, 246)',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
                ],
                [
                    'label' => 'Announcements',
                    'data' => $announcementData,
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                ],
                [
                    'label' => 'Agendas',
                    'data' => $agendaData,
                    'borderColor' => 'rgb(14, 165, 233)',
                    'backgroundColor' => 'rgba(14, 165, 233, 0.1)',
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
