<?php

namespace T0team\LaravelPanel\Controllers\Form;

use T0team\LaravelPanel\Traits\InputTrait;

class Option
{
    use InputTrait;

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public static function make(string $label): Option
    {
        return new self($label);
    }
}
