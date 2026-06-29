<?php

use JeffersonGoncalves\Erp\Manufacturing\Models\Workstation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\CreateWorkstation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\EditWorkstation;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\Pages\ListWorkstations;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the workstation list page', function () {
    Livewire::test(ListWorkstations::class)->assertSuccessful();
});

it('can list workstations in the table', function () {
    $workstation = Workstation::factory()->create();

    Livewire::test(ListWorkstations::class)
        ->assertCanSeeTableRecords([$workstation]);
});

it('can render the workstation create page', function () {
    Livewire::test(CreateWorkstation::class)->assertSuccessful();
});

it('can create a workstation through the form', function () {
    Livewire::test(CreateWorkstation::class)
        ->fillForm([
            'name' => 'Assembly Line A',
            'hour_rate' => 50,
            'production_capacity' => 2,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Workstation::query()->where('name', 'Assembly Line A')->exists())->toBeTrue();
});

it('can render the workstation edit page', function () {
    $workstation = Workstation::factory()->create();

    Livewire::test(EditWorkstation::class, ['record' => $workstation->getRouteKey()])
        ->assertSuccessful();
});
