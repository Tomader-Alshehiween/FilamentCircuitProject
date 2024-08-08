<?php

namespace App\Filament\Resources;

use App\Filament\Exports\CircuitExporter;
use App\Filament\Resources\CircuitResource\Pages;
use App\Filament\Resources\CircuitResource\RelationManagers;
use App\Models\Circuit;
use App\Models\CircuitStatus;
use App\Models\CircuitTypes;
use App\Models\EntityName;
use App\Models\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Exports\CircuitExport;
//use Illuminate\Support\Facades\Route;
//use Maatwebsite\Excel\Facades\Excel;
class CircuitResource extends Resource
{
    protected static ?string $model = Circuit::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = "Circuits";
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('circuit_number')->label('Circuit Number')->required(),
                TextInput::make('speed')->label('Speed')->required(),
                Select::make('service_provider_id')
                    ->label('Service Provider')
                    ->options(ServiceProvider::all()->pluck('service_provider', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('circuit_type_id')
                    ->label('Circuit Type')
                    ->options(CircuitTypes::all()->pluck('circuit_type', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('entity_name_id')
                    ->label('Entity Name')
                    ->options(EntityName::all()->pluck('entity_name', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('circuit_status_id')
                    ->label('Circuit Status')
                    ->options(CircuitStatus::all()->pluck('circuit_status', 'id'))
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('circuit_number')->label('Circuit Number')->searchable(),
                TextColumn::make('speed')->label('Speed')->sortable(),
                TextColumn::make('ServiceProvider.service_provider')->label('Service Provider')->sortable()->searchable(),
                TextColumn::make('circuitType.circuit_type')->label('Circuit Type')->searchable(),
                TextColumn::make('EntityName.entity_name')->label('Entity Name')->searchable(),
                TextColumn::make('CircuitStatus.circuit_status')->label('Circuit Status')->searchable(),
            ])
            ->filters([
                //
                SelectFilter::make('service_provider_id')
                ->options(ServiceProvider::all()->pluck('service_provider', 'id'))
                ->multiple(),
                SelectFilter::make('circuit_type_id')
                    ->options(CircuitTypes::all()->pluck('circuit_type', 'id'))
                    ->multiple(),
                SelectFilter::make('entity_name_id')
                    ->options(EntityName::all()->pluck('entity_name', 'id'))
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('circuit_status_id')
                    ->options(CircuitStatus::all()->pluck('circuit_status', 'id'))
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->headerActions([
                Tables\Actions\ButtonAction::make('export') // Use a custom button action
                ->label('Export Circuits')
                    ->url('/circuit-export') // Link to the export route
                    ->color('success'), // Optional styling
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCircuits::route('/'),
            'create' => Pages\CreateCircuit::route('/create'),
            'edit' => Pages\EditCircuit::route('/{record}/edit'),

        ];
    }
}
