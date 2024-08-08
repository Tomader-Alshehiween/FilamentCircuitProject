<?php
namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Event::query()
            ->select([
                'events.id as EventID',
                'events.created_at as createdAt',
                'circuits.circuit_number as circuitNumber',
                'events.completion_date as completedAt',
                'events.report_detail as reportDetail',
                'report_statuses.report_status as reportStatus',
            ])
            ->join('circuits', 'events.circuit_id', '=', 'circuits.id')
            ->join('report_statuses', 'events.report_status_id', '=', 'report_statuses.id');
    }

    public function headings(): array
    {
        return [
            'Event ID',
            'Created At',
            'Circuit Number',
            'Completed At',
            'Report Detail',
            'Report Status',
        ];
    }
}
