<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Pages\CreateOperation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Pages\EditOperation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Pages\ListOperations;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Schemas\OperationForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\Tables\OperationsTable;

class OperationResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::operation();
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
        return OperationForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return OperationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOperations::route('/'),
            'create' => CreateOperation::route('/create'),
            'edit' => EditOperation::route('/{record}/edit'),
        ];
    }
}
