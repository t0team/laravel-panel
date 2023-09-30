<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class ViewMaker extends Maker
{
    private string $viewName;
    private Collection $with;

    public function __construct(string $view, array $config)
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->handle($config);

        $this->viewName = $view;

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
        $this->data['view'] = view($this->viewName, $this->with);
    }
}
