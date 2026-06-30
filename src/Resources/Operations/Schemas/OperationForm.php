<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class OperationForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('workstation_id')
                            ->label('Workstation')
                            ->relationship('workstation', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
