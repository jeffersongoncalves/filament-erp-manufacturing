<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OperationsRelationManager extends RelationManager
{
    protected static string $relationship = 'operations';

    protected static ?string $title = 'Operations';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Select::make('operation_id')
                    ->label('Operation')
                    ->relationship('operation', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('workstation_id')
                    ->label('Workstation')
                    ->relationship('workstation', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric()
                    ->default(0),
                TextInput::make('hour_rate')
                    ->label('Hour Rate')
                    ->numeric()
                    ->default(0),
                TextInput::make('operating_cost')
                    ->label('Operating Cost')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('operation_id')
            ->columns([
                TextColumn::make('operation.name')
                    ->label('Operation')
                    ->searchable(),
                TextColumn::make('workstation.name')
                    ->label('Workstation')
                    ->toggleable(),
                TextColumn::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric(),
                TextColumn::make('hour_rate')
                    ->label('Hour Rate')
                    ->numeric(),
                TextColumn::make('operating_cost')
                    ->label('Operating Cost')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
