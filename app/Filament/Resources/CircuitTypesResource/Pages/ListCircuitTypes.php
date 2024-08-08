<?php

namespace App\Filament\Resources\CircuitTypesResource\Pages;

use App\Filament\Resources\CircuitTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCircuitTypes extends ListRecords
{
    protected static string $resource = CircuitTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
