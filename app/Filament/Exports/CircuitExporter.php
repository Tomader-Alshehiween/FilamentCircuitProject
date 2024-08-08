

/*namespace App\Filament\Exports;

use App\Models\Circuit;
use App\Models\CircuitTypes;
use App\Models\ServiceProvider;
use App\Models\CircuitStatus;
use App\Models\EntityName;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Log;

class CircuitExporter extends Exporter
{
    protected static ?string $model = Circuit::class;

    /*public function query()
    {
        // Fetch data with the necessary joins
        return Circuit::query()
            ->select([
                'circuits.id',
                'circuits.circuit_number',
                'circuits.speed',
                'service_providers.service_provider',
                'circuit_types.circuit_type',
                'entity_names.entity_name',
                'circuit_statuses.circuit_status',
            ])
            ->join('service_providers', 'circuits.service_provider_id', '=', 'service_providers.id')
            ->join('circuit_types', 'circuits.circuit_type_id', '=', 'circuit_types.id')
            ->join('entity_names', 'circuits.entity_name_id', '=', 'entity_names.id')
            ->join('circuit_statuses', 'circuits.circuit_status_id', '=', 'circuit_statuses.id');
    }*/
    public function query()
    {
        return Circuit::query()
            ->select([
                'circuits.id as circuitID',
                'circuits.circuit_number as circuitNumber',
                'circuits.speed as circuitSpeed',
                'service_providers.service_provider as serviceProviderName',
                'circuit_types.circuit_type as circuitTypeName',
                'entity_names.entity_name as entityName_Name',
                'circuit_statuses.circuit_status as circuitStatusName',
            ])
            ->join('service_providers', 'circuits.service_provider_id', '=', 'service_providers.id')
            ->join('circuit_types', 'circuits.circuit_type_id', '=', 'circuit_types.id')
            ->join('entity_names', 'circuits.entity_name_id', '=', 'entity_names.id')
            ->join('circuit_statuses', 'circuits.circuit_status_id', '=', 'circuit_statuses.id');
    }

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('circuitID')->label('ID'),
            ExportColumn::make('circuitNumber')->label('Circuit Number'),
            ExportColumn::make('circuitSpeed')->label('Speed'),
            ExportColumn::make('serviceProviderName')->label('Service Provider'),
            ExportColumn::make('circuitTypeName')->label('Circuit Type'),
            ExportColumn::make('entityName_Name')->label('Entity Name'),
            ExportColumn::make('circuitStatusName')->label('Circuit Status'),
        ];
    }


    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your circuit export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}*/
