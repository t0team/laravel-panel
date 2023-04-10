<?php

namespace T0team\LaravelPanel\Traits;

use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

trait ButtonTrait
{
    private ?string $label = null;
    private ?string $icon = null;
    private string $color = 'primary';
    private bool $outLine = false;
    private bool $disabled = false;
    private bool $hidden = false;
    private ?string $rel = null;
    private ?string $target = null;
    private string $size = 'md';

    private ?string $buttonType = null;
    private ?string $url = null;
    private ?array $route = null;


    public function label(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function icon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function color(?string $color): self
    {
        Color::is_available_color($color) || throw new \Exception("Color not available In [" . Color::class . "]");

        $this->color = $color;

        return $this;
    }

    public function outLine(bool $outLine = true): self
    {
        $this->outLine = $outLine;

        return $this;
    }

    public function disabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function hidden(bool $hidden = true): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function rel(?string $rel): self
    {
        $this->rel = $rel;

        return $this;
    }

    public function target(?string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function openInNewTab(bool $openInNewTab = true): self
    {
        if ($openInNewTab) {
            $this->target = '_blank';
        } else {
            $this->target = null;
        }

        return $this;
    }

    public function size(string $size): self
    {
        Size::is_available_size($size) || throw new \Exception("Size not available In [" . Size::class . "]");

        $this->size = $size;

        return $this;
    }

    // actions
    public function url(?string $url): self
    {
        if (is_null($url)) {
            $this->buttonType = null;
            $this->url = null;

            return $this;
        }

        // validate url
        filter_var($url, FILTER_VALIDATE_URL) || throw new \Exception("[{$url}] is not a valid url");

        $this->buttonType = 'url';
        $this->url = $url;

        return $this;
    }

    public function route(?string $routeName, array $routeNeeded = []): self
    {
        if (is_null($routeName)) {
            $this->buttonType = null;
            $this->route = null;

            return $this;
        }

        // validate route
        \Route::has($routeName) || throw new \Exception("[{$routeName}] is not a valid route");

        $this->buttonType = 'route';
        $this->route = ['name' => $routeName, 'needed' => $routeNeeded];

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
            'icon' => $this->icon,
            'color' => $this->color,
            'outLine' => $this->outLine,
            'disabled' => $this->disabled,
            'hidden' => $this->hidden,
            'rel' => $this->rel,
            'target' => $this->target,
            'size' => $this->size,

            'buttonType' => $this->buttonType,
            'url' => $this->url,
            'route' => $this->route,
        ]);
    }

    private function customGet(): array
    {
        return [];
    }
}
