<?php

namespace LazySoft\LaravelPanel\Controllers;

use Illuminate\Support\Facades\View;

class MakeView
{
    private $view;

    public function __construct(string $view, array $attributes = [])
    {
        // check if the view exists
        if (!View::exists($view)) {
            throw new \Exception("View '{$view}' does not exist");
        }

        // create a new view instance and pass the attributes
        $this->view = View::make("panel::index", $attributes)
            ->with('panelViewContent', view($view));

        return $this;
    }

    public function with(string $key, $value): MakeView
    {
        $this->view->with($key, $value);
        return $this;
    }

    public function setUserInfo(string $name, string $userSide = null, string $email = null, string $image = null): MakeView
    {
        $this->with('panelUserName', $name);
        $this->with('panelUserSide', $userSide);
        $this->with('panelUserImage', $image);
        $this->with('panelUserEmail', $email);

        return $this;
    }

    public function render()
    {
        return $this->view->render();
    }
}
