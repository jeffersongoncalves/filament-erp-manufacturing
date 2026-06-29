<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\JobCardResource;

class ListJobCards extends ListRecords
{
    protected static string $resource = JobCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
