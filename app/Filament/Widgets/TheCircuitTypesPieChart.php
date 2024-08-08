<?php

namespace App\Filament\Widgets;

use App\Models\Circuit;
use App\Models\CircuitTypes;
use Filament\Widgets\ChartWidget;


class TheCircuitTypesPieChart extends ChartWidget
{
    protected static ?string $heading = 'Circuit types';

    protected function getData(): array
    {
        $circuitStatuses = Circuit::selectRaw('circuit_types.circuit_type as type_name, COUNT(circuits.id) as count')
            ->join('circuit_types', 'circuits.circuit_type_id', '=', 'circuit_types.id')
            ->groupBy('circuit_types.circuit_type')
            ->get();

        $labels = $circuitStatuses->pluck('type_name')->toArray();
        $counts = $circuitStatuses->pluck('count')->toArray();
        return [
            //
            'datasets' => [
                [
                    'data' => $counts,
                    'backgroundColor' => [
                        '#ecc813', //DIA
                        '#25bdda', //DIASMW
                        '#3e25da', //IP
                        '#d12dd2', //IPMW
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
