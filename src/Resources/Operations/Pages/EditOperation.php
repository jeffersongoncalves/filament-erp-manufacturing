<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\OperationResource;

class EditOperation extends EditRecord
{
    protected static string $resource = OperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
