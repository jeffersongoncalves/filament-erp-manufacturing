<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class RoutingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('disabled')
                    ->label('Disabled')
                    ->boolean()
                    ->toggleable(),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('disabled')
                    ->label('Disabled'),
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
