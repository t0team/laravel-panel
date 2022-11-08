<?php

namespace LazySoft\LaravelPanel\Controllers;

use LazySoft\LaravelPanel\Controllers\Makers\TableMaker;
use LazySoft\LaravelPanel\Controllers\Makers\ViewMaker;
use LazySoft\LaravelPanel\Controllers\Makers\FormMaker;

class Panel
{
    private array $config;

    public function __construct()
    {
        $this->config = config('panel');
    }

    public function view(string $view): ViewMaker
    {
        return new ViewMaker($view, $this->config);
    }

    public function table(array $headers): TableMaker
    {
        return new TableMaker($headers, $this->config);
    }

    public function form(string $routeNameOrUrl, array $routeNeeded = [], string $formMethod = 'POST', string $laravelMethod = 'POST'): FormMaker
    {
        return new FormMaker($routeNameOrUrl, $routeNeeded, $formMethod, $laravelMethod, $this->config);
    }
}
