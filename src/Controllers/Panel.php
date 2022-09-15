<?php

namespace LazySoft\LaravelPanel\Controllers;

use LazySoft\LaravelPanel\Controllers\Makers\ViewMaker;
use LazySoft\LaravelPanel\Controllers\Makers\TableMaker;

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
}
