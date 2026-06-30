<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequiredItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'requiredItems';

    protected static ?string $title = 'Required Items';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
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
