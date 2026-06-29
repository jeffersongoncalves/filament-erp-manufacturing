<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\WorkOrderResource;

class ListWorkOrders extends ListRecords
{
    protected static string $resource = WorkOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
