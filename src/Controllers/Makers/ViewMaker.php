<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class ViewMaker extends Maker
{
    private string $view;
    private Collection $with;

    public function make(string $view): static
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->view = $view;
        $this->with = collect();

        return $this;
    }

    public function with(Arrayable|array|string $key, $value = null): self
    {
        if (is_string($key)) {
            $key = [$key => $value];
        }

        $this->with = $this->with->merge($key);

        return $this;
    }

    protected function beforeRender()
    {
        $this->data->put('view', view($this->view, $this->with));
    }
}
