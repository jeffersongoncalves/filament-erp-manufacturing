<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Manufacturing\Concerns\HasErpManufacturingPluginConfig;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\BomResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\JobCardResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\OperationResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RoutingResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\WorkOrderResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\WorkstationResource;

class FilamentErpManufacturingPlugin implements Plugin
{
    use HasErpManufacturingPluginConfig;

    public function getId(): string
    {
        return 'filament-erp-manufacturing';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
            'workstation' => WorkstationResource::class,
            'operation' => OperationResource::class,
            'bom' => BomResource::class,
            'routing' => RoutingResource::class,
            'work_order' => WorkOrderResource::class,
            'job_card' => JobCardResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
