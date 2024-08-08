<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntityNameResource\Pages;
use App\Filament\Resources\EntityNameResource\RelationManagers;
use App\Models\EntityName;
use App\Models\EntityType;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntityNameResource extends Resource
{
    protected static ?string $model = EntityName::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = "Entities";
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('entity_name')->label('Entity Name')->required(),
                Select::make('entity_type_id')
                    ->label('Entity Type')
                    ->options(EntityType::all()->pluck('entity_type', 'id'))
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('entity_name')->label('Entity Name'),
                TextColumn::make('entityType.entity_type')->label('Entity Type'),
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
            'index' => Pages\ListEntityNames::route('/'),
            'create' => Pages\CreateEntityName::route('/create'),
            'edit' => Pages\EditEntityName::route('/{record}/edit'),
        ];
    }
}
