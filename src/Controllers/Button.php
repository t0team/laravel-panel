<?php

namespace T0team\LaravelPanel\Controllers;

use T0team\LaravelPanel\Traits\ButtonTrait;

class Button
{
    use ButtonTrait;

    public static function make(): Button
    {
        return new self();
    }
}
