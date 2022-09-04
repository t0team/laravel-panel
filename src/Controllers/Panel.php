<?php

namespace LazySoft\LaravelPanel\Controllers;

class Panel
{
    private object $config;

    public function __construct()
    {
        $this->config = (object) config('panel');
    }

    public function makeView(string $view): MakeView
    {
        return new MakeView($view, $this->config);
    }
}
