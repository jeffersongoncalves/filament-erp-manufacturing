<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\WorkOrderResource;

class CreateWorkOrder extends CreateRecord
{
    protected static string $resource = WorkOrderResource::class;
}
