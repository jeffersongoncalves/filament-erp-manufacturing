<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                FilamentErpManufacturingPlugin::make(),
            ]);
    }
}
