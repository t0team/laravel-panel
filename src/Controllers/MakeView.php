<?php

namespace LazySoft\LaravelPanel\Controllers;

use Illuminate\Support\Facades\View;
use LazySoft\LaravelPanel\Traits\MakerTrait;

class MakeView
{
    use MakerTrait;

    private $panel;
    private string $viewName;
    private array $with = [];
    private array $data = [];

    public function __construct(string $view, array $config)
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->data['config'] = $config;
        $this->viewName = $view;
        $this->panel = View::make("panel::index");

        $this->fixSidebarItems();
        $this->fixUserInfo();

        return $this;
    }

    public function with(array|string $key, $value = null): MakeView
    {
        $key = is_array($key) ? $key : [$key => $value];

        foreach ($key as $k => $v) {
            $this->with[$k] = $v;
        }

        return $this;
    }

    private function beforeRender()
    {
        $this->data['view'] = view($this->viewName, $this->with);
    }
}
