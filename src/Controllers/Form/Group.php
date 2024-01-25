<?php

use Illuminate\Support\Collection;
namespace T0team\LaravelPanel\Controllers\Form;

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

    public function input(Input $input): Group
    {
        $this->inputs[] = $input->get();

        return $this;
    }

    public function inputs(Collection|array $inputs): Group
    {
        foreach ($inputs as $input) {
            $this->input($input);
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
        $cols[] = "col-{$this->col}";
        if ($this->colSm) $cols[] = "col-sm-{$this->colSm}";
        if ($this->colMd) $cols[] = "col-md-{$this->colMd}";
        if ($this->colLg) $cols[] = "col-lg-{$this->colLg}";
        if ($this->colXl) $cols[] = "col-xl-{$this->colXl}";

        return implode(' ', $cols);
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
