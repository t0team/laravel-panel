<?php

namespace T0team\LaravelPanel\Traits;

use T0team\LaravelPanel\Controllers\Form\Option;

trait InputTrait
{
    private ?string $label = null;
    private ?string $value = null;
    private ?string $tableProperty = null;
    private ?string $placeholder = null;
    private ?string $min = null;
    private ?string $max = null;
    private ?string $accept = null;
    private ?string $step = null;
    private ?int $size = null;
    private ?int $minLength = null;
    private ?int $maxLength = null;
    private ?int $rows = null;
    private ?int $cols = null;
    private bool $withOldValue = true;
    private bool $required = false;
    private bool $disabled = false;
    private bool $readonly = false;
    private bool $autofocus = false;
    private bool $autocomplete = false;
    private bool $multiple = false;
    private bool $selected = false;
    private bool $checked = false;
    private array $options = [];
    private array $classes = [];


    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function value(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function tableProperty(string $property): self
    {
        $this->tableProperty = $property;

        return $this;
    }

    public function withOldValue(bool $withOldValue = true): self
    {
        $this->withOldValue = $withOldValue;

        return $this;
    }

    public function placeholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function required(bool $required = true): self
    {
        $this->required = $required;

        if ($required && $this->label) {
            $this->label .= ' *';
        } elseif (!$required) {
            $this->label = str_replace(' *', '', $this->label);
        }

        return $this;
    }

    public function disabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function readonly(bool $readonly = true): self
    {
        $this->readonly = $readonly;

        return $this;
    }

    public function autofocus(bool $autofocus = true): self
    {
        $this->autofocus = $autofocus;

        return $this;
    }

    public function autocomplete(bool $autocomplete = true): self
    {
        $this->autocomplete = $autocomplete;

        return $this;
    }

    public function size(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function minLength(?int $minLength): self
    {
        $this->minLength = $minLength;

        return $this;
    }

    public function maxLength(?int $maxLength): self
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    public function min(?string $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function max(?string $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function rows(?int $rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    public function cols(?int $cols): self
    {
        $this->cols = $cols;

        return $this;
    }

    public function multiple(bool $multiple = true): self
    {
        $this->multiple = $multiple;

        if ($multiple && ($this->type === 'select' || $this->type === 'file')) {
            $this->name .= '[]';
        } else {
            $this->name = str_replace('[]', '', $this->name);
        }

        return $this;
    }

    public function selected(bool $selected = true): self
    {
        $this->selected = $selected;

        return $this;
    }

    public function checked(bool $checked = true): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function accept(?string $accept = null): self
    {
        $this->accept = $accept;

        return $this;
    }

    public function step(?string $step = null): self
    {
        $this->step = $step;

        return $this;
    }

    public function option(Option $option): self
    {
        $this->options[] = $option->get();

        return $this;
    }

    public function options(array $options): self
    {
        foreach ($options as $option) {
            $this->option($option);
        }

        return $this;
    }

    protected function addClass(string $class): self
    {
        $this->classes[] = $class;

        return $this;
    }

    protected function addClasses(array $classes): self
    {
        foreach ($classes as $class) {
            $this->addClass($class);
        }

        return $this;
    }

    public function when(bool $condition, callable $callback): self
    {
        if ($condition) {
            return $callback($this);
        }

        return $this;
    }

    public function get(): object
    {
        return (object) array_merge($this->customGet(), [
            'label' => $this->label,
            'value' => $this->value,
            'tableProperty' => $this->tableProperty,
            'placeholder' => $this->placeholder,
            'withOldValue' => $this->withOldValue,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
            'autofocus' => $this->autofocus,
            'autocomplete' => $this->autocomplete,
            'size' => $this->size,
            'minlength ' => $this->minLength,
            'maxLength' => $this->maxLength,
            'min' => $this->min,
            'max' => $this->max,
            'rows' => $this->rows,
            'cols' => $this->cols,
            'multiple' => $this->multiple,
            'selected' => $this->selected,
            'checked' => $this->checked,
            'accept' => $this->accept,
            'step' => $this->step,
            'options' => $this->options,
            'classes' => $this->classes,
        ]);
    }

    private function customGet(): array
    {
        return [];
    }
}
