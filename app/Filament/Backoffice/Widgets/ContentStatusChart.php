<?php

namespace App\Filament\Backoffice\Widgets;

use App\Models\News;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Announcement;
use App\Models\Agenda;
use Filament\Widgets\ChartWidget;

class ContentStatusChart extends ChartWidget
{
    protected ?string $heading = 'Content Status Distribution';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Define the statuses we want to track
        $statuses = ['draft', 'published', 'archived'];
        
        // Count content by status
        $newsCounts = [];
        $announcementCounts = [];
        $agendaCounts = [];
        
        foreach ($statuses as $status) {
            $newsCounts[] = News::where('status', $status)->count();
            $announcementCounts[] = Announcement::where('status', $status)->count();
            $agendaCounts[] = Agenda::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'News',
                    'data' => $newsCounts,
                    'backgroundColor' => 'rgb(59, 130, 246)',
                ],
                [
                    'label' => 'Announcements',
                    'data' => $announcementCounts,
                    'backgroundColor' => 'rgb(239, 68, 68)',
                ],
                [
                    'label' => 'Agendas',
                    'data' => $agendaCounts,
                    'backgroundColor' => 'rgb(14, 165, 233)',
                ],
            ],
            'labels' => array_map('ucfirst', $statuses),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}