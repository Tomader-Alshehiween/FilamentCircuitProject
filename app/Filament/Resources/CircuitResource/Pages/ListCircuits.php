<?php

namespace App\Filament\Resources\CircuitResource\Pages;

use App\Exports\CircuitsExport;
use App\Filament\Resources\CircuitResource;
use Filament\Actions;
use Filament\Tables\Actions\ButtonAction;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListCircuits extends ListRecords
{
    protected static string $resource = CircuitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getActions(): array
    {
        return [
            ButtonAction::make('export')
                ->label('Export Circuits')
                ->action('exportCircuits')
                ->color('primary')
                ->icon('heroicon-o-download'),
        ];
    }

    public function exportCircuits()
    {
        return Excel::download(new CircuitsExport, 'circuits.xlsx');
    }
}
