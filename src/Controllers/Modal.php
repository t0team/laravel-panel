<?php

namespace T0team\LaravelPanel\Controllers;

use T0team\LaravelPanel\Traits\ModalTrait;

class Modal
{
    use ModalTrait;

    public function __construct(?string $customKey = null, bool $open = false)
    {
        $this->id = uniqid();
        $this->open = $open;

        // replace all characters except letters, numbers , _ and - to _
        $this->customKey = preg_replace('/[^a-zA-Z0-9_-]/', '_', $customKey);
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
