<?php

namespace LazySoft\LaravelPanel\Controllers;

use Illuminate\Support\Facades\View;

class MakeView
{
    private $view;
    private object $config;
    private array $lPanel = [];

    public function __construct(string $view, object $config)
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->config = $config;
        $this->view = View::make("panel::index");
        $this->lPanel['view'] = view($view);

        $this->fixUserInfo();

        return $this;
    }

    private function fixUserInfo()
    {
        if (!auth()->check()) {
            return;
        }
        $user = auth()->user();
        $params = $this->config->user;

        // get all params
        foreach (explode(',', $params['name']) as $item) {
            $names[] = $user->$item;
        }

        $this->setUserInfo(
            implode(' ', $names) ?? null,
            $user->{$params['side']} ?? null,
            $user->{$params['email']} ?? null,
            $user->{$params['image']} ?? null
        );
    }

    public function with(string $key, $value): MakeView
    {
        if ($key == 'lPanel') {
            throw new \Exception("Key [lPanel] are reserved");
        }

        $this->view->with($key, $value);
        return $this;
    }

    public function setUserInfo(string $name, string $userSide = null, string $email = null, string $image = null): MakeView
    {
        $this->lPanel['user'] = (object) [
            'name' => $name,
            'side' => $userSide,
            'email' => $email,
            'image' => $image,
        ];

        return $this;
    }

    public function setPageTitle(string $title): MakeView
    {
        if ($title != null && $title != '') {
            $this->lPanel['title'] = $title;
        }

        return $this;
    }

    public function setPageButton(
        string $title,
        string $url,
        string $icon = null,
        string $color = 'primary',
        bool $outLine = false,
        bool $openInNewTab = false
    ): MakeView {
        $this->lPanel['button'] = (object) [
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'color' => $color,
            'outLine' => $outLine,
            'blanck' => $openInNewTab,
        ];

        return $this;
    }

    public function render()
    {
        $this->lPanel['config'] = $this->config;
        $this->view->with('lPanel', (object) $this->lPanel);

        return $this->view->render();
    }
}
