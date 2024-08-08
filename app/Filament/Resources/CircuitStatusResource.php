<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CircuitStatusResource\Pages;
use App\Filament\Resources\CircuitStatusResource\RelationManagers;
use App\Models\CircuitStatus;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CircuitStatusResource extends Resource
{
    protected static ?string $model = CircuitStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = "Circuits";
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('circuit_status')->label('status')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('circuit_status'),
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
            'index' => Pages\ListCircuitStatuses::route('/'),
            'create' => Pages\CreateCircuitStatus::route('/create'),
            'edit' => Pages\EditCircuitStatus::route('/{record}/edit'),
        ];
    }
}
