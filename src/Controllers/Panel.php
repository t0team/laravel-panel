<?php

namespace LazySoft\LaravelPanel\Controllers;

class Panel
{
    public function makeView(string $view, array $attributes = []): MakeView
    {
        return new MakeView($view, $attributes);
    }
}
