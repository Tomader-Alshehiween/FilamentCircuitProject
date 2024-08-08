<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CompletedEventsLineChart extends ChartWidget
{
    protected static ?string $heading = 'Completed Events';
    //protected static string $view = 'filament.widgets.completed-events-line-chart';

    protected function getData(): array
    {
        // Fetch event data and group by month
        $events = Event::select(
            DB::raw('DATE_FORMAT(completion_date, "%Y-%m-%d") as day'),
            DB::raw('count(*) as count')
        )
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $labels = $events->pluck('day')->toArray();
        $counts = $events->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Number of Events',
                    'data' => $counts,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
