<?php

namespace T0team\LaravelPanel\Facades;

use Illuminate\Support\Facades\Facade;
use T0team\LaravelPanel\Controllers\Makers\ViewMaker;
use T0team\LaravelPanel\Controllers\Makers\TableMaker;
use T0team\LaravelPanel\Controllers\Makers\FormMaker;

/**
 * @method static ViewMaker view(string $view)
 * @method static TableMaker table(array $headers)
 * @method static FormMaker form(string $routeNameOrUrl, array $routeNeeded = [], string $formMethod = 'POST', string $laravelMethod = 'POST')
 *
 * @see \T0team\LaravelPanel\Controllers\Panel
 */
class Panel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'panel';
    }
}
