<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('item_name')
                    ->label('Item Name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('uom.name')
                    ->label('UOM')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('raw_material_cost')
                    ->label('Raw Material Cost')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('operating_cost')
                    ->label('Operating Cost')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('total_cost')
                    ->label('Total Cost')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->toggleable(),
                IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('item_code')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Is Active'),
                TernaryFilter::make('is_default')
                    ->label('Is Default'),
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
