<?php

namespace LazySoft\LaravelPanel\Facades;

use Illuminate\Support\Facades\Facade;
use LazySoft\LaravelPanel\Controllers\MakeView;

/**
 * @method static MakeView makeView(string $view)
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
