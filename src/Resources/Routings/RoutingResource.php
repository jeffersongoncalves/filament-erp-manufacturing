<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowPath;

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

    public static function form(Schema $schema): Schema
    {
        return RoutingForm::configure($schema);
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
