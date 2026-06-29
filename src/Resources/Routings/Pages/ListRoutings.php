<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RoutingResource;

class ListRoutings extends ListRecords
{
    protected static string $resource = RoutingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
