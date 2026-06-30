<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OperationsRelationManager extends RelationManager
{
    protected static string $relationship = 'operations';

    protected static ?string $title = 'Operations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
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
                TextInput::make('sequence_id')
                    ->label('Sequence')
                    ->numeric()
                    ->integer()
                    ->default(0),
                TextInput::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('operation_id')
            ->defaultSort('sequence_id')
            ->columns([
                TextColumn::make('sequence_id')
                    ->label('Sequence')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('operation.name')
                    ->label('Operation')
                    ->searchable(),
                TextColumn::make('workstation.name')
                    ->label('Workstation')
                    ->toggleable(),
                TextColumn::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric(),
            ])
            ->headerActions([
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
