<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\JobCardResource;

class EditJobCard extends EditRecord
{
    protected static string $resource = JobCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
