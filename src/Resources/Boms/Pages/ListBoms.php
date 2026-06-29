<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\BomResource;

class ListBoms extends ListRecords
{
    protected static string $resource = BomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
