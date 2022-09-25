<?php

namespace LazySoft\LaravelPanel\Controllers\Form;

use LazySoft\LaravelPanel\Traits\InputTrait;

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
