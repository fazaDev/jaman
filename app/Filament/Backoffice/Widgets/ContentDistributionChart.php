<?php

namespace App\Filament\Backoffice\Widgets;

use App\Models\News;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Announcement;
use App\Models\Agenda;
use Filament\Widgets\ChartWidget;

class ContentDistributionChart extends ChartWidget
{
    protected ?string $heading = 'Content Distribution';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Content Items',
                    'data' => [
                        News::count(),
                        Page::count(),
                        Slider::count(),
                        Gallery::count(),
                        Announcement::count(),
                        Agenda::count(),
                    ],
                    'backgroundColor' => [
                        'rgb(59, 130, 246)', // blue
                        'rgb(16, 185, 129)', // green
                        'rgb(245, 158, 11)', // amber
                        'rgb(139, 92, 246)', // violet
                        'rgb(239, 68, 68)',  // red
                        'rgb(14, 165, 233)', // sky
                    ],
                ],
            ],
            'labels' => [
                'News',
                'Pages',
                'Sliders',
                'Gallery',
                'Announcements',
                'Agendas',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
