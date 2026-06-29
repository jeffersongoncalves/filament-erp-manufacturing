<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoutingForm
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
                        Toggle::make('disabled')
                            ->label('Disabled')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
