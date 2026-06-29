<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class BomForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('item_code')
                            ->label('Item Code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('item_name')
                            ->label('Item Name')
                            ->maxLength(255),
                        TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->default(1),
                        Select::make('uom_id')
                            ->label('UOM')
                            ->relationship('uom', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                    ])->columns(2),
                Section::make('Options')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Is Active')
                            ->default(true),
                        Toggle::make('is_default')
                            ->label('Is Default')
                            ->default(false),
                        Toggle::make('with_operations')
                            ->label('With Operations')
                            ->default(false),
                    ])->columns(3),
                Section::make('Costs')
                    ->schema([
                        TextInput::make('raw_material_cost')
                            ->label('Raw Material Cost')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('operating_cost')
                            ->label('Operating Cost')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('total_cost')
                            ->label('Total Cost')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(3),
            ]);
    }
}
