<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Manufacturing\Enums\JobCardStatus;
use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;

class JobCardsTable
{
    use SubmittableRecordActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('workOrder.production_item')
                    ->label('Work Order')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('operation.name')
                    ->label('Operation')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('workstation.name')
                    ->label('Workstation')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('for_quantity')
                    ->label('For Qty')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('total_completed_qty')
                    ->label('Completed')
                    ->numeric()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state instanceof JobCardStatus ? $state->value : (string) $state)
                    ->color(fn ($state): string => match ($state) {
                        JobCardStatus::Open => 'gray',
                        JobCardStatus::WorkInProgress => 'info',
                        JobCardStatus::Completed => 'success',
                        JobCardStatus::OnHold => 'warning',
                        JobCardStatus::Cancelled => 'danger',
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
            ->recordActions([
                Actions\EditAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
                ...self::submittableRecordActions(),
                Actions\DeleteAction::make()
                    ->visible(fn ($record): bool => $record->docstatus === DocStatus::Draft),
            ]);
    }

    /** @return array<string, string> */
    protected static function statusOptions(): array
    {
        $options = [];

        foreach (JobCardStatus::cases() as $case) {
            $options[$case->value] = $case->value;
        }

        return $options;
    }
}
