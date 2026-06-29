<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Pages\CreateJobCard;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Pages\EditJobCard;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Pages\ListJobCards;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\RelationManagers\TimeLogsRelationManager;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Schemas\JobCardForm;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Tables\JobCardsTable;

class JobCardResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?int $navigationSort = 11;

    protected static ?string $recordTitleAttribute = 'naming_series';

    public static function getModel(): string
    {
        return ModelResolver::jobCard();
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
        return JobCardForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return JobCardsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TimeLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobCards::route('/'),
            'create' => CreateJobCard::route('/create'),
            'edit' => EditJobCard::route('/{record}/edit'),
        ];
    }
}
