<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Circuit;
use App\Models\Event;
use App\Models\ReportStatus;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationGroup = "Reports";
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                DatePicker::make('completion_date')
                    ->visible(fn ($livewire) => !($livewire instanceof CreateRecord))
                    ->label('Completion Date'),
                Textarea::make('report_detail')->label('Report Detail')->required(),
                Select::make('circuit_id')
                    ->label('Circuit')
                    ->options(Circuit::all()->pluck('circuit_number', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('report_status_id')
                    ->label('Report Status')
                    ->options(ReportStatus::all()->pluck('report_status', 'id'))
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('completion_date')->label('Completion Date'),
                TextColumn::make('report_detail')->label('Report Detail'),
                TextColumn::make('circuit.circuit_number')->label('Circuit')->sortable()->searchable(),
                TextColumn::make('reportStatus.report_status')->label('Report Status')->sortable(),
                TextColumn::make('created_at')->label('Reported At')->sortable(),
            ])
            ->filters([
                //
                SelectFilter::make('report_status_id')
                    ->options(ReportStatus::all()->pluck('report_status', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->headerActions([
                Tables\Actions\ButtonAction::make('export') // Use a custom button action
                ->label('Export Events')
                    ->url('/event-export') // Link to the export route
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
