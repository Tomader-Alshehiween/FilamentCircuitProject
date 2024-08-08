<?php

namespace App\Filament\Widgets;

use App\Models\Circuit;
use Filament\Widgets\ChartWidget;

class TheCircuitStatusPieChart extends ChartWidget
{
    protected static ?string $heading = 'Circuit Status';

    protected function getData(): array
    {
        $circuitStatuses = Circuit::selectRaw('circuit_statuses.circuit_status as status_name, COUNT(circuits.id) as count')
            ->join('circuit_statuses', 'circuits.circuit_status_id', '=', 'circuit_statuses.id')
            ->groupBy('circuit_statuses.circuit_status')
            ->get();

        $labels = $circuitStatuses->pluck('status_name')->toArray();
        $counts = $circuitStatuses->pluck('count')->toArray();
        return [
            //
            'datasets' => [
                [
                    'data' => $counts,
                    'backgroundColor' => [
                        '#4eb171', //Active
                        '#FFCE56', //Decommissioned
                        '#eb141d', //Faulty
                        '#75788a', //Inactive
                        '#4f29d6' //Maintenence

                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
