<?php

it('loads the filament-erp-manufacturing config file', function () {
    expect(config('filament-erp-manufacturing'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-manufacturing.navigation_group'))->toBe('ERP — Manufacturing');
});

it('registers all resources in config', function () {
    $resources = config('filament-erp-manufacturing.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'workstation',
            'operation',
            'bom',
            'routing',
            'work_order',
            'job_card',
        ]);
});

it('registers the dashboard widgets in config', function () {
    expect(config('filament-erp-manufacturing.widgets'))->toBeArray()
        ->toHaveKeys(['work_order_stats']);
});
