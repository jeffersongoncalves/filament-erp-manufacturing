<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Concerns;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Manufacturing\Models\WorkOrder;
use JeffersonGoncalves\Erp\Manufacturing\Services\WorkOrderService;
use JeffersonGoncalves\Erp\Stock\Support\ModelResolver as StockModelResolver;

/**
 * The "Manufacture" record action for a submitted work order. It collects the
 * work-in-progress (source) and finished-goods (target) warehouses in a modal,
 * then hands off to {@see WorkOrderService::manufacture()} which builds the
 * cross-module Manufacture stock entry that consumes the raw materials and
 * produces the finished good. Any failure (e.g. a missing stock item, an
 * overdrawn bin) is surfaced as a Filament danger notification.
 */
trait ManufacturesWorkOrders
{
    public static function manufactureAction(): Action
    {
        return Action::make('manufacture')
            ->label('Manufacture')
            ->icon(Heroicon::OutlinedCog6Tooth)
            ->color('primary')
            ->visible(fn (Model $record): bool => $record->getAttribute('docstatus') === DocStatus::Submitted)
            ->schema([
                Select::make('wip_warehouse_id')
                    ->label('WIP Warehouse')
                    ->options(fn (): array => static::warehouseOptions())
                    ->default(fn (Model $record): mixed => $record->getAttribute('wip_warehouse_id'))
                    ->searchable(),
                Select::make('fg_warehouse_id')
                    ->label('FG Warehouse')
                    ->options(fn (): array => static::warehouseOptions())
                    ->default(fn (Model $record): mixed => $record->getAttribute('fg_warehouse_id'))
                    ->searchable(),
            ])
            ->action(function (Model $record, array $data): void {
                if (! $record instanceof WorkOrder) {
                    return;
                }

                $wip = isset($data['wip_warehouse_id']) ? (int) $data['wip_warehouse_id'] : null;
                $fg = isset($data['fg_warehouse_id']) ? (int) $data['fg_warehouse_id'] : null;

                try {
                    $entry = app(WorkOrderService::class)->manufacture($record, $wip, $fg);

                    Notification::make()
                        ->title('Work order manufactured')
                        ->body('Stock Entry #'.$entry->getKey().' created.')
                        ->success()
                        ->send();
                } catch (\Throwable $exception) {
                    Notification::make()
                        ->title('Unable to manufacture work order')
                        ->body($exception->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /** @return array<int|string, string> */
    protected static function warehouseOptions(): array
    {
        return StockModelResolver::warehouse()::query()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->all();
    }
}
