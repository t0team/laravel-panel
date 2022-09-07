<?php

namespace LazySoft\LaravelPanel\Controllers;

class Panel
{
    private array $config;

    public function __construct()
    {
        $this->config = config('panel');
    }

    public function view(string $view): MakeView
    {
        return new MakeView($view, $this->config);
    }

    public function table(array $headers): MakeTable
    {
        return new MakeTable($headers, $this->config);
    }
}
