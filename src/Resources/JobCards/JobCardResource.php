<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
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
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

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

    public static function form(Schema $schema): Schema
    {
        return JobCardForm::configure($schema);
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
