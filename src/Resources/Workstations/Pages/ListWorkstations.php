<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\WorkstationResource;

class ListWorkstations extends ListRecords
{
    protected static string $resource = WorkstationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
