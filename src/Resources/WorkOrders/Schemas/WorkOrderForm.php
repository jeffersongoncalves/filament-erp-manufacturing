<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorkOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Details')
                    ->schema([
                        TextInput::make('production_item')
                            ->label('Production Item')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('item_name')
                            ->label('Item Name')
                            ->maxLength(255),
                        Select::make('bom_id')
                            ->label('BOM')
                            ->relationship('bom', 'item_code')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('qty')
                            ->label('Qty')
                            ->numeric()
                            ->default(1),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        DateTimePicker::make('planned_start_date')
                            ->label('Planned Start Date'),
                    ])->columns(2),
                Section::make('Warehouses')
                    ->schema([
                        Select::make('wip_warehouse_id')
                            ->label('WIP Warehouse')
                            ->relationship('wipWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('fg_warehouse_id')
                            ->label('FG Warehouse')
                            ->relationship('fgWarehouse', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
