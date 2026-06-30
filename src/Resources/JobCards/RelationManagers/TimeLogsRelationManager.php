<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimeLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'timeLogs';

    protected static ?string $title = 'Time Logs';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                DateTimePicker::make('from_time')
                    ->label('From Time'),
                DateTimePicker::make('to_time')
                    ->label('To Time'),
                TextInput::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric()
                    ->default(0),
                TextInput::make('completed_qty')
                    ->label('Completed Qty')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('from_time')
                    ->label('From Time')
                    ->dateTime(),
                TextColumn::make('to_time')
                    ->label('To Time')
                    ->dateTime(),
                TextColumn::make('time_in_mins')
                    ->label('Time (mins)')
                    ->numeric(),
                TextColumn::make('completed_qty')
                    ->label('Completed Qty')
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
