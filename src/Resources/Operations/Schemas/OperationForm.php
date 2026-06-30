<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OperationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
