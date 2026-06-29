<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\WorkOrderResource;

class EditWorkOrder extends EditRecord
{
    protected static string $resource = WorkOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
