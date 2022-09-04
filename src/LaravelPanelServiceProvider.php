<?php

namespace LazySoft\LaravelPanel;

use LazySoft\LaravelPanel\Controllers\Panel;
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
            ->hasAssets()
            ->hasRoute('web');

        $this->app->bind('panel', fn () => new Panel());
    }
}
