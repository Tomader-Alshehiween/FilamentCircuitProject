<?php
namespace App\Exports;

use App\Models\Circuit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CircuitExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Circuit::query()
            ->select([
                'circuits.id as circuitID',
                'circuits.circuit_number as circuitNumber',
                'circuits.speed as circuitSpeed',
                'service_providers.service_provider as serviceProviderName',
                'circuit_types.circuit_type as circuitTypeName',
                'entity_name.entity_name as entityName_Name',
                'circuit_statuses.circuit_status as circuitStatusName',
            ])
            ->join('service_providers', 'circuits.service_provider_id', '=', 'service_providers.id')
            ->join('circuit_types', 'circuits.circuit_type_id', '=', 'circuit_types.id')
            ->join('entity_name', 'circuits.entity_name_id', '=', 'entity_name.id')
            ->join('circuit_statuses', 'circuits.circuit_status_id', '=', 'circuit_statuses.id');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Circuit Number',
            'Speed',
            'Service Provider',
            'Circuit Type',
            'Entity Name',
            'Circuit Status',
        ];
    }
}
