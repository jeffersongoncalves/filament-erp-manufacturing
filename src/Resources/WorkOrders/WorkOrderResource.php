<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\CreateWorkOrder;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\EditWorkOrder;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\ListWorkOrders;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\RelationManagers\RequiredItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Schemas\WorkOrderForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Tables\WorkOrdersTable;

class WorkOrderResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'production_item';

    public static function getModel(): string
    {
        return ModelResolver::workOrder();
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
        return WorkOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RequiredItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkOrders::route('/'),
            'create' => CreateWorkOrder::route('/create'),
            'edit' => EditWorkOrder::route('/{record}/edit'),
        ];
    }
}
