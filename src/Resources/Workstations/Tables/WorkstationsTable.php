<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkstationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hour_rate')
                    ->label('Hour Rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('production_capacity')
                    ->label('Capacity')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('name')
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
