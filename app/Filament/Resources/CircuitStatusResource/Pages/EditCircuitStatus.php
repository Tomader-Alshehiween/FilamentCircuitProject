<?php

namespace App\Filament\Resources\CircuitStatusResource\Pages;

use App\Filament\Resources\CircuitStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCircuitStatus extends EditRecord
{
    protected static string $resource = CircuitStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
