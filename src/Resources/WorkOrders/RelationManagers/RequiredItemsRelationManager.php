<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequiredItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'requiredItems';

    protected static ?string $title = 'Required Items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('item_code')
                    ->label('Item Code')
                    ->required()
                    ->maxLength(255),
                Select::make('source_warehouse_id')
                    ->label('Source Warehouse')
                    ->relationship('sourceWarehouse', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('required_qty')
                    ->label('Required Qty')
                    ->numeric()
                    ->default(0),
                TextInput::make('transferred_qty')
                    ->label('Transferred Qty')
                    ->numeric()
                    ->default(0),
                TextInput::make('consumed_qty')
                    ->label('Consumed Qty')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_code')
            ->columns([
                TextColumn::make('item_code')
                    ->label('Item Code')
                    ->searchable(),
                TextColumn::make('sourceWarehouse.name')
                    ->label('Source Warehouse')
                    ->toggleable(),
                TextColumn::make('required_qty')
                    ->label('Required')
                    ->numeric(),
                TextColumn::make('transferred_qty')
                    ->label('Transferred')
                    ->numeric(),
                TextColumn::make('consumed_qty')
                    ->label('Consumed')
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
