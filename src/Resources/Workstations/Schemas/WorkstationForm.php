<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WorkstationForm
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
