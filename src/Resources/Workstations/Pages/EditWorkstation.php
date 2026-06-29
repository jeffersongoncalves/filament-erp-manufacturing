<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\WorkstationResource;

class EditWorkstation extends EditRecord
{
    protected static string $resource = WorkstationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
