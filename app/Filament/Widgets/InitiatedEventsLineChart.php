<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\ReportStatus;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InitiatedEventsLineChart extends ChartWidget
{
    protected static ?string $heading = 'Events Initiated Chart';
    //protected static string $view = 'filament.widgets.event-line-chart';

    protected function getData(): array
    {
        $data = Trend::model(Event::class)
            ->between(
                start: now()->subDay(7),
                end: now(),
            )
            ->perDay()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Events Initiated per Day',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
