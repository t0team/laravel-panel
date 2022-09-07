<?php

namespace LazySoft\LaravelPanel\Facades;

use Illuminate\Support\Facades\Facade;
use LazySoft\LaravelPanel\Controllers\MakeView;
use LazySoft\LaravelPanel\Controllers\MakeTable;

/**
 * @method static MakeView view(string $view)
 * @method static MakeTable table(array $headers)
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
