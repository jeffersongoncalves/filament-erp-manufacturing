<?php

use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Boms\BomResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\JobCards\JobCardResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Operations\OperationResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Routings\RoutingResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\WorkOrders\WorkOrderResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Resources\Workstations\WorkstationResource;
use JeffersonGoncalves\FilamentErp\Manufacturing\Widgets\WorkOrderStatsWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP manufacturing resources are listed
    | in the Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Manufacturing',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'workstation' => WorkstationResource::class,
        'operation' => OperationResource::class,
        'bom' => BomResource::class,
        'routing' => RoutingResource::class,
        'work_order' => WorkOrderResource::class,
        'job_card' => JobCardResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'work_order_stats' => WorkOrderStatsWidget::class,
    ],

];
