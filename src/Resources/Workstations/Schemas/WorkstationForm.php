<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class WorkstationForm
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
                        TextInput::make('hour_rate')
                            ->label('Hour Rate')
                            ->numeric()
                            ->default(0),
                        TextInput::make('production_capacity')
                            ->label('Production Capacity')
                            ->numeric()
                            ->integer()
                            ->default(1),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
