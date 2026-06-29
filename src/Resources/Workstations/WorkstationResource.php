<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\CreateWorkstation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\EditWorkstation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\ListWorkstations;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Schemas\WorkstationForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Tables\WorkstationsTable;

class WorkstationResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::workstation();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpManufacturingPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-manufacturing.navigation_group', 'ERP — Manufacturing');
        }
    }

    public static function form(Form $form): Form
    {
        return WorkstationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return WorkstationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkstations::route('/'),
            'create' => CreateWorkstation::route('/create'),
            'edit' => EditWorkstation::route('/{record}/edit'),
        ];
    }
}
