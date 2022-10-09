<?php

namespace LazySoft\LaravelPanel\Controllers\Form;

class Group
{
    private ?string $title = null;
    private array $inputs = [];
    private ?int $col = 12;     // default 
    private ?int $colSm = null; // in mobile
    private ?int $colMd = null; // in tablet
    private ?int $colLg = null; // in laptop
    private ?int $colXl = null; // in desktop

    public function __construct($title)
    {
        $this->title = $title;
    }

    public static function make(?string $title = null): Group
    {
        return new self($title);
    }

    public function addInput($input): Group
    {
        if ($input instanceof Input) {
            $this->inputs[] = $input->get();
        }

        return $this;
    }

    public function addInputs(array $inputs): Group
    {
        foreach ($inputs as $input) {
            $this->addInput($input);
        }

        return $this;
    }

    public function col(int $col): Group
    {
        $this->col = $col;

        return $this;
    }

    public function colMobile(int $col): Group
    {
        $this->colSm = $col;

        return $this;
    }

    public function colTablet(int $col): Group
    {
        $this->colMd = $col;

        return $this;
    }

    public function colLaptop(int $col): Group
    {
        $this->colLg = $col;

        return $this;
    }

    public function colDesktop(int $col): Group
    {
        $this->colXl = $col;

        return $this;
    }

    private function fixCol(): string
    {
        return "col-{$this->col} col-sm-{$this->colSm} col-md-{$this->colMd} col-lg-{$this->colLg} col-xl-{$this->colXl}";
    }

    public function get(): object
    {
        return (object) [
            'title' => $this->title,
            'classes' => $this->fixCol(),
            'inputs' => $this->inputs,
        ];
    }
}
