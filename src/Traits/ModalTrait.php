<?php

namespace T0team\LaravelPanel\Traits;

use T0team\LaravelPanel\Controllers\Button;
use T0team\LaravelPanel\Controllers\Form\Input;
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

trait ModalTrait
{
    private string $id;
    public ?string $customKey = null;
    private bool $open = false;

    private ?string $title = null;
    private array $body = [];
    private ?object $form = null;

    private bool $staticBackdrop = false;
    private bool $verticalCenter = false;
    private string $size = 'md';
    private bool $fullscreen = false;
    private ?object $close = null;


    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function staticBackdrop(bool $staticBackdrop = true): self
    {
        $this->staticBackdrop = $staticBackdrop;

        return $this;
    }

    public function verticalCenter(bool $verticalCenter = true): self
    {
        $this->verticalCenter = $verticalCenter;

        return $this;
    }

    public function size(string $size): self
    {
        Size::is_available_size($size) || throw new \Exception("Size not available In [" . Size::class . "]");

        $this->size = $size;

        return $this;
    }

    public function fullscreen(bool $fullscreen = true): self
    {
        $this->fullscreen = $fullscreen;

        return $this;
    }

    public function closeButton(string $label, string $size = 'md'): self
    {
        $this->close = (object)[
            'label' => $label,
            'size' => $size,
        ];

        return $this;
    }

    public function formOption(string $routeNameOrUrl, array $routeNeeded = [], string $method = 'POST'): self
    {
        $this->form = (object)[
            'address' => $routeNameOrUrl,
            'needed' => $routeNeeded,
            'method' => $method,
        ];

        return $this;
    }

    public function formSubmitButton(string $label, string $color = 'primary', string $size = 'md'): self
    {
        Color::is_available_color($color) || throw new \Exception("Submit Color not available In [" . Color::class . "]");
        Size::available_sizes($size) || throw new \Exception("Submit Size not available In [" . Size::class . "]");

        $this->form->submit = (object)[
            'label' => $label,
            'color' => $color,
            'size' => $size,
        ];

        return $this;
    }

    //-------------------- body --------------------

    public function text(string $text, ?string $htmlTag = null): self
    {
        $this->body[] = ['type' => 'text', 'text' => $text, 'htmlTag' => $htmlTag];

        return $this;
    }

    public function html(string $html): self
    {
        $this->body[] = ['type' => 'html', 'html' => $html];

        return $this;
    }

    public function tableProperty(string $property, ?string $htmlTag = null): self
    {
        $this->body[] = ['type' => 'tableProperty', 'property' => $property, 'htmlTag' => $htmlTag];

        return $this;
    }

    public function newLine(): self
    {
        $this->body[] = ['type' => 'newLine'];

        return $this;
    }

    public function button(Button $button): self
    {
        $this->body[] = ['type' => 'button', 'button' => $button->get()];

        return $this;
    }

    public function input(Input $input): self
    {
        $this->body[] = ['type' => 'input', 'input' => $input->get()];

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
            'id' => $this->id,
            'customKey' => $this->customKey,
            'open' => $this->open,
            'title' => $this->title,
            'body' => $this->body,
            'form' => $this->form,
            'staticBackdrop' => $this->staticBackdrop,
            'verticalCenter' => $this->verticalCenter,
            'size' => $this->size,
            'fullscreen' => $this->fullscreen,
            'close' => $this->close,
        ]);
    }

    private function customGet(): array
    {
        return [];
    }
}
