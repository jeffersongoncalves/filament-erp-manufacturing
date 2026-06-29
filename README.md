<div class="filament-hidden">

![Filament ERP Manufacturing](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-manufacturing/3.x/art/jeffersongoncalves-filament-erp-manufacturing.png)

</div>

# Filament ERP Manufacturing

Filament v5 panel resources for the [Laravel ERP manufacturing module](https://github.com/jeffersongoncalves/laravel-erp-manufacturing) — BOMs, work orders and job cards.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-manufacturing` domain package (namespace `JeffersonGoncalves\Erp\Manufacturing\`). It wires the manufacturing models into Filament resources, with Submit/Cancel actions and a cross-module Manufacture action that consumes raw materials and produces the finished good.

## Features

- **Master resources** — Workstations, operations, bills of materials and routings
- **Transaction resources** — Work orders and job cards, each with relation managers
- **Document lifecycle** — Submit/Cancel record actions on work orders and job cards
- **Manufacture action** — Builds the cross-module Manufacture stock entry from a submitted work order
- **Dashboard widget** — `WorkOrderStatsWidget` with open/submitted work order counts and quantity

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-manufacturing
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Manufacturing\FilamentErpManufacturingPlugin;

$panel->plugin(
    FilamentErpManufacturingPlugin::make()
        ->navigationGroup('ERP — Manufacturing'),
);
```

## Resources

| Resource | Purpose |
|----------|---------|
| `WorkstationResource` | Workstations (hour rate, production capacity) |
| `OperationResource` | Operations (workstation) |
| `BomResource` | Bills of materials (+ Items RM, Operations RM, computed costs) |
| `RoutingResource` | Routings (+ Operations RM) |
| `WorkOrderResource` | Work orders (+ Required Items RM, Submit/Cancel, Manufacture) |
| `JobCardResource` | Job cards (+ Time Logs RM, Submit/Cancel) |

Transaction resources (work orders, job cards) expose **Submit** and **Cancel** record actions that drive the domain document lifecycle. A submitted work order also exposes a **Manufacture** action: it collects the WIP (source) and FG (target) warehouses and builds the cross-module Manufacture stock entry that consumes the raw materials and produces the finished good.

## Widgets

| Widget | Purpose |
|--------|---------|
| `WorkOrderStatsWidget` | Count and quantity of open/submitted work orders |

## Configuration

Publish the config to swap resource classes, change the navigation group, or adjust widgets:

```bash
php artisan vendor:publish --tag="filament-erp-manufacturing-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
