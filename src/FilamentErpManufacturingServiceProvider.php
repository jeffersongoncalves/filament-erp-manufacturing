<?php

namespace JeffersonGoncalves\FilamentErp\Manufacturing;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpManufacturingServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-manufacturing';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
