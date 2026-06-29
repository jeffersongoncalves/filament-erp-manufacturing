<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\RelationManagers;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimeLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'timeLogs';

    protected static ?string $title = 'Time Logs';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
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
