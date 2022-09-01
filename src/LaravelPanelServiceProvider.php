<?php

namespace Ahr1384\LaravelPanel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPanelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-panel')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web');
    }
}
