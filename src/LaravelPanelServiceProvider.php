<?php

namespace T0team\LaravelPanel;

use Illuminate\Pagination\Paginator;
use T0team\LaravelPanel\Controllers\Panel;
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
            ->hasAssets();

        $this->app->bind('panel', fn () => new Panel());
    }

    public function bootingPackage()
    {
        Paginator::useBootstrapFour();
    }
}
