<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Pages\CreateRouting;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Pages\EditRouting;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Pages\ListRoutings;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RelationManagers\OperationsRelationManager;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Schemas\RoutingForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\Tables\RoutingsTable;

class RoutingResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::routing();
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
        return RoutingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return RoutingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OperationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoutings::route('/'),
            'create' => CreateRouting::route('/create'),
            'edit' => EditRouting::route('/{record}/edit'),
        ];
    }
}
