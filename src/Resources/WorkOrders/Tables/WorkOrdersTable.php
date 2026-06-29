<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Manufacturing\Enums\WorkOrderStatus;
use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;
use JeffersonGoncalves\FilamentErp\Manufacturing\Concerns\ManufacturesWorkOrders;

class WorkOrdersTable
{
    use ManufacturesWorkOrders;
    use SubmittableRecordActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('production_item')
                    ->label('Production Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('bom.item_code')
                    ->label('BOM')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('qty')
                    ->label('Qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('produced_qty')
                    ->label('Produced')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof WorkOrderStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        WorkOrderStatus::Draft => 'gray',
                        WorkOrderStatus::NotStarted => 'warning',
                        WorkOrderStatus::InProcess => 'info',
                        WorkOrderStatus::Completed => 'success',
                        WorkOrderStatus::Stopped => 'danger',
                        WorkOrderStatus::Cancelled => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('docstatus')
                    ->label('Doc Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof DocStatus ? $state->name : $state)
                    ->color(fn ($state): string => match ($state) {
                        DocStatus::Draft => 'gray',
                        DocStatus::Submitted => 'success',
                        DocStatus::Cancelled => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->toggleable()
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
                SelectFilter::make('docstatus')
                    ->label('Doc Status')
                    ->options([
                        0 => 'Draft',
                        1 => 'Submitted',
                        2 => 'Cancelled',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
                ...self::submittableRecordActions(),
                self::manufactureAction(),
                Actions\DeleteAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
            ]);
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        $options = [];

        foreach (WorkOrderStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
