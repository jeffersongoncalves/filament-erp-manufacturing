<?php

use Filament\Actions\Testing\TestAction;
use JeffersonGoncalves\Erp\Core\Models\Company;
use JeffersonGoncalves\Erp\Manufacturing\Models\Bom;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\CreateBom;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\EditBom;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\Pages\ListBoms;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\RelationManagers\ItemsRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = Company::factory()->create();
});

it('can render the bom list page', function () {
    Livewire::test(ListBoms::class)->assertSuccessful();
});

it('can render the bom create page', function () {
    Livewire::test(CreateBom::class)->assertSuccessful();
});

it('can render the bom edit page', function () {
    $bom = Bom::factory()->create(['company_id' => $this->company->id]);

    Livewire::test(EditBom::class, ['record' => $bom->getRouteKey()])
        ->assertSuccessful();
});

it('can create a bom through the form', function () {
    Livewire::test(CreateBom::class)
        ->fillForm([
            'item_code' => 'FG-CHAIR',
            'item_name' => 'Wooden Chair',
            'quantity' => 1,
            'company_id' => $this->company->id,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Bom::query()->where('item_code', 'FG-CHAIR')->exists())->toBeTrue();
});

it('recomputes the bom cost when item lines are added through the relation manager', function () {
    $bom = Bom::factory()->create([
        'item_code' => 'FG-CHAIR',
        'quantity' => 1,
        'company_id' => $this->company->id,
    ]);

    Livewire::test(ItemsRelationManager::class, [
        'ownerRecord' => $bom,
        'pageClass' => EditBom::class,
    ])
        ->callAction(TestAction::make('create')->table(), data: [
            'item_code' => 'RAW-WOOD',
            'qty' => 4,
            'rate' => 7.5,
        ])
        ->assertHasNoActionErrors();

    $bom->refresh();

    expect($bom->items)->toHaveCount(1)
        ->and($bom->raw_material_cost)->toBe(30.0)
        ->and($bom->total_cost)->toBe(30.0);
});
