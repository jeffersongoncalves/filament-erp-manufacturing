<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\BomResource;

class CreateBom extends CreateRecord
{
    protected static string $resource = BomResource::class;
}
