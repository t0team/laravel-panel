<?php

namespace T0team\LaravelPanel\Controllers;

use T0team\LaravelPanel\Traits\ModalTrait;

class Modal
{
    use ModalTrait;

    public function __construct(?string $customKey = null, bool $open = false)
    {
        $this->id = uniqid();
        $this->customKey = $customKey;
        $this->open = $open;
    }

    public static function make(?string $customKey = null): Modal
    {
        return new self($customKey);
    }

    public static function open(string $customKey): Modal
    {
        return new self($customKey, true);
    }
}
