<?php

namespace LazySoft\LaravelPanel\Controllers;

use Illuminate\Support\Facades\View;

class MakeView
{
    private $panel;
    private string $view;
    private object $config;
    private array $attrs = [];
    private array $with = [];

    public function __construct(string $view, object $config)
    {
        if (!View::exists($view)) {
            throw new \Exception("View [{$view}] does not exist");
        }

        $this->config = $config;
        $this->attrs['config'] = $this->config;
        $this->view = $view;
        $this->panel = View::make("panel::index");

        $this->fixSidebarItems();
        $this->fixUserInfo();

        return $this;
    }

    private function fixSidebarItems()
    {
        $items = $this->config->items;

        foreach ($items as $key => $item) {
            $url = route($key, [], false);
            $newItems[$url] = (object) [
                'name' => $item['name'],
                'icon' => $item['icon'],
                'active' => in_array(request()->route()->getName(), [$key, ...$item['activeIn']]),
            ];
        }

        $this->attrs['items'] = $newItems;
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
        $this->with[$key] = $value;
        return $this;
    }

    public function setUserInfo(string $name, string $userSide = null, string $email = null, string $image = null): MakeView
    {
        $this->attrs['user'] = (object) [
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
            $this->attrs['title'] = $title;
        }

        return $this;
    }

    public function setPageButton(
        string $title,
        string $routeNameOrUrl,
        string $icon = null,
        string $color = 'primary',
        bool $outLine = false,
        bool $openInNewTab = false
    ): MakeView {
        if (strpos($routeNameOrUrl, 'http') !== false) {
            $url = $routeNameOrUrl;
        } else {
            $url = route($routeNameOrUrl);
        }

        $this->attrs['button'] = (object) [
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
        $this->attrs['view'] = view($this->view, $this->with);

        $this->panel->with($this->attrs);

        return $this->panel->render();
    }
}
