<?php

namespace T0team\LaravelPanel\Controllers\Form;

use T0team\LaravelPanel\Traits\InputTrait;

class Input
{
    use InputTrait;

    private string $file;
    private string $type;
    private string $name;

    public function __construct(string $type, string $name, string $file = 'input', array $classes = [])
    {
        $this->type = $type;
        $this->name = $name;
        $this->file = $file;
        $this->addClasses($classes);
    }

    public static function text(string $name): Input
    {
        return new self('text', $name);
    }

    public static function number(string $name): Input
    {
        return new self('number', $name);
    }

    public static function email(string $name): Input
    {
        return new self('email', $name);
    }

    public static function password(string $name): Input
    {
        return new self('password', $name);
    }

    public static function select(string $name): Input
    {
        return new self('select', $name, 'select');
    }

    public static function radio(string $name): Input
    {
        return new self('radio', $name, 'radio');
    }

    public static function checkbox(string $name): Input
    {
        return new self('checkbox', $name, 'checkbox');
    }

    public static function switch(string $name): Input
    {
        return new self('checkbox', $name, 'switch');
    }

    public static function textarea(string $name): Input
    {
        return new self('textarea', $name, 'textarea');
    }

    public static function hidden(string $name): Input
    {
        return new self('hidden', $name);
    }

    public static function file(string $name): Input
    {
        return new self('file', $name);
    }

    public static function range(string $name): Input
    {
        return new self('range', $name, 'range');
    }

    public static function date(string $name): Input
    {
        return new self('date', $name);
    }

    public static function time(string $name): Input
    {
        return new self('time', $name);
    }

    public static function datetime(string $name): Input
    {
        return new self('datetime-local', $name);
    }

    public static function week(string $name): Input
    {
        return new self('week', $name);
    }

    public static function month(string $name): Input
    {
        return new self('month', $name);
    }

    public static function color(string $name): Input
    {
        return new self('color', $name, 'input', ['form-control-color']);
    }

    public static function url(string $name): Input
    {
        return new self('url', $name);
    }

    public static function search(string $name): Input
    {
        return new self('search', $name);
    }


    private function customGet(): array
    {
        return [
            'file' => $this->file,
            'name' => $this->name,
            'type' => $this->type,
            'id' => "{$this->type}_{$this->name}",
        ];
    }
}
