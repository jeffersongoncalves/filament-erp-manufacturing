<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OperationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('workstation.name')
                    ->label('Workstation')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('workstation')
                    ->label('Workstation')
                    ->relationship('workstation', 'name')
                    ->searchable()
                    ->preload(),
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
