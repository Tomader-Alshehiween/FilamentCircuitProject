<?php

namespace App\Filament\Resources\CircuitStatusResource\Pages;

use App\Filament\Resources\CircuitStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCircuitStatuses extends ListRecords
{
    protected static string $resource = CircuitStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
