<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\BomResource;

class EditBom extends EditRecord
{
    protected static string $resource = BomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
