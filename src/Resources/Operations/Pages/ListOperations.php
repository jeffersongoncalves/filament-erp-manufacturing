<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\OperationResource;

class ListOperations extends ListRecords
{
    protected static string $resource = OperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
