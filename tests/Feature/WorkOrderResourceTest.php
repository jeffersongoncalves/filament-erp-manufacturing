<?php

use Filament\Actions\Testing\TestAction;
use JeffersonGoncalves\Erp\Core\Enums\DocStatus;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Manufacturing\Models\Bom;
use JeffersonGoncalves\Erp\Manufacturing\Models\WorkOrder;
use JeffersonGoncalves\Erp\Stock\Enums\StockEntryType;
use JeffersonGoncalves\Erp\Stock\Models\Item;
use JeffersonGoncalves\Erp\Stock\Models\StockEntry;
use JeffersonGoncalves\Erp\Stock\Models\Warehouse;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\CreateWorkOrder;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\EditWorkOrder;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\Pages\ListWorkOrders;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
    $this->wip = Warehouse::factory()->create(['company_id' => $this->company->id]);
    $this->fg = Warehouse::factory()->create(['company_id' => $this->company->id]);

    $this->rawItem = Item::factory()->create(['item_code' => 'RAW-STEEL']);
    $this->finishedItem = Item::factory()->create(['item_code' => 'FG-WIDGET']);

    // Seed raw-material stock in the WIP warehouse so the production consume
    // does not overdraw the bin.
    $receipt = StockEntry::factory()->type(StockEntryType::MaterialReceipt)->create([
        'company_id' => $this->company->id,
        'to_warehouse_id' => $this->wip->id,
    ]);
    $receipt->items()->create([
        'item_id' => $this->rawItem->id,
        't_warehouse_id' => $this->wip->id,
        'qty' => 100,
        'basic_rate' => 5,
    ]);
    $receipt->refresh()->submit();

    $this->bom = Bom::factory()->create([
        'item_code' => 'FG-WIDGET',
        'quantity' => 1,
        'company_id' => $this->company->id,
    ]);
    $this->bom->items()->create(['item_code' => 'RAW-STEEL', 'qty' => 2, 'rate' => 5]);
});

function makeWorkOrder(): WorkOrder
{
    return WorkOrder::factory()->create([
        'production_item' => 'FG-WIDGET',
        'bom_id' => test()->bom->id,
        'qty' => 10,
        'company_id' => test()->company->id,
        'wip_warehouse_id' => test()->wip->id,
        'fg_warehouse_id' => test()->fg->id,
    ]);
}

it('can render the work order list page', function () {
    Livewire::test(ListWorkOrders::class)->assertSuccessful();
});

it('can render the work order create page', function () {
    Livewire::test(CreateWorkOrder::class)->assertSuccessful();
});

it('can render the work order edit page', function () {
    $workOrder = makeWorkOrder();

    Livewire::test(EditWorkOrder::class, ['record' => $workOrder->getRouteKey()])
        ->assertSuccessful();
});

it('submits a work order through the UI and populates required items from the bom', function () {
    $workOrder = makeWorkOrder();

    Livewire::test(ListWorkOrders::class)
        ->callAction(TestAction::make('submit')->table($workOrder));

    $workOrder->refresh();

    expect($workOrder->docstatus)->toBe(DocStatus::Submitted)
        ->and($workOrder->requiredItems)->toHaveCount(1)
        ->and($workOrder->requiredItems->first()->item_code)->toBe('RAW-STEEL')
        ->and($workOrder->requiredItems->first()->required_qty)->toBe(20.0);
});

it('manufactures a submitted work order through the UI, creating a Manufacture stock entry', function () {
    $workOrder = makeWorkOrder();

    Livewire::test(ListWorkOrders::class)
        ->callAction(TestAction::make('submit')->table($workOrder));

    expect($workOrder->refresh()->docstatus)->toBe(DocStatus::Submitted);

    Livewire::test(ListWorkOrders::class)
        ->callAction(TestAction::make('manufacture')->table($workOrder), data: [
            'wip_warehouse_id' => $this->wip->id,
            'fg_warehouse_id' => $this->fg->id,
        ]);

    $entry = StockEntry::query()
        ->where('stock_entry_type', StockEntryType::Manufacture->value)
        ->latest('id')
        ->first();

    expect($entry)->not->toBeNull()
        ->and($entry->stock_entry_type)->toBe(StockEntryType::Manufacture)
        ->and($entry->items)->toHaveCount(2);

    $rawLine = $entry->items->firstWhere('item_id', $this->rawItem->id);
    $fgLine = $entry->items->firstWhere('item_id', $this->finishedItem->id);

    expect($rawLine)->not->toBeNull()
        ->and($rawLine->s_warehouse_id)->toBe($this->wip->id)
        ->and($rawLine->qty)->toBe(20.0)
        ->and($fgLine)->not->toBeNull()
        ->and($fgLine->t_warehouse_id)->toBe($this->fg->id)
        ->and($fgLine->qty)->toBe(10.0);
});
