<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RoutingResource;

class EditRouting extends EditRecord
{
    protected static string $resource = RoutingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
