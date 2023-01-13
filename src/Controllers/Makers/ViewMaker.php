<?php

namespace LazySoft\LaravelPanel\Controllers\Makers;

use Illuminate\Support\Facades\View;

class ViewMaker extends Maker
{
    private string $viewName;
    private array $with = [];

    public function __construct(string $view, array $config)
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->handle($config);

        $this->viewName = $view;

        return $this;
    }

    public function with(array|string $key, $value = null): self
    {
        $key = is_array($key) ? $key : [$key => $value];

        foreach ($key as $k => $v) {
            $this->with[$k] = $v;
        }

        return $this;
    }

    protected function beforeRender()
    {
        $this->data['view'] = view($this->viewName, $this->with);
    }
}
