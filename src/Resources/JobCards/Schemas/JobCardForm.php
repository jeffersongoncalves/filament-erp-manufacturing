<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class JobCardForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        Select::make('work_order_id')
                            ->label('Work Order')
                            ->relationship('workOrder', 'production_item')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('operation_id')
                            ->label('Operation')
                            ->relationship('operation', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('workstation_id')
                            ->label('Workstation')
                            ->relationship('workstation', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('company_id')
                            ->label('Company')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('for_quantity')
                            ->label('For Quantity')
                            ->numeric()
                            ->default(0),
                        TextInput::make('total_completed_qty')
                            ->label('Total Completed Qty')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }
}
