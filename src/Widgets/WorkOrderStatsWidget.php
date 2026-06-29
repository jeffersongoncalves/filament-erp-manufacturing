<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Manufacturing\Enums\WorkOrderStatus;
use JeffersonGoncalves\Erp\Manufacturing\Support\ModelResolver;

/**
 * How many work orders are live on the shop floor — submitted but not yet
 * completed or cancelled — and the total quantity they represent.
 */
class WorkOrderStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $workOrderModel = ModelResolver::workOrder();

        $open = $workOrderModel::query()
            ->where('docstatus', DocStatus::Submitted->value)
            ->whereNotIn('status', [
                WorkOrderStatus::Completed->value,
                WorkOrderStatus::Cancelled->value,
            ]);

        $openCount = (clone $open)->count();
        $openQty = (float) (clone $open)->sum('qty');

        $submitted = $workOrderModel::query()
            ->where('docstatus', DocStatus::Submitted->value)
            ->count();

        return [
            Stat::make('Open Work Orders', (string) $openCount)
                ->description(number_format($openQty, 2).' unit(s) to produce')
                ->color($openCount > 0 ? 'primary' : 'gray'),
            Stat::make('Submitted Work Orders', (string) $submitted)
                ->description('total submitted')
                ->color('success'),
        ];
    }
}
