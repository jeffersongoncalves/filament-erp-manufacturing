<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Concerns;

use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpPluginConfig;

trait HasErpManufacturingPluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-manufacturing';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Manufacturing';
    }
}
