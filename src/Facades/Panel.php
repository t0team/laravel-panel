<?php

namespace LazySoft\LaravelPanel\Facades;

use Illuminate\Support\Facades\Facade;
use LazySoft\LaravelPanel\Controllers\Makers\ViewMaker;
use LazySoft\LaravelPanel\Controllers\Makers\TableMaker;
use LazySoft\LaravelPanel\Controllers\Makers\FormMaker;

/**
 * @method static ViewMaker view(string $view)
 * @method static TableMaker table(array $headers)
 * @method static FormMaker form(string $routeNameOrUrl, string $formMethod = 'POST', string $laravelMethod = 'POST')
 * 
 * @see \LazySoft\LaravelPanel\Controllers\Panel
 */
class Panel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'panel';
    }
}
