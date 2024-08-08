<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CircuitTypesResource\Pages;
use App\Filament\Resources\CircuitTypesResource\RelationManagers;
use App\Models\CircuitTypes;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CircuitTypesResource extends Resource
{
    protected static ?string $model = CircuitTypes::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationGroup = "Circuits";
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('circuit_type')->label('Type')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('circuit_type')->label('Type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCircuitTypes::route('/'),
            'create' => Pages\CreateCircuitTypes::route('/create'),
            'edit' => Pages\EditCircuitTypes::route('/{record}/edit'),
        ];
    }
}
