<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\CreateBom;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\EditBom;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\ListBoms;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\RelationManagers\ItemsRelationManager;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\RelationManagers\OperationsRelationManager;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Schemas\BomForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Tables\BomsTable;

class BomResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'item_code';

    public static function getModel(): string
    {
        return ModelResolver::bom();
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
        return BomForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BomsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
            OperationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBoms::route('/'),
            'create' => CreateBom::route('/create'),
            'edit' => EditBom::route('/{record}/edit'),
        ];
    }
}
