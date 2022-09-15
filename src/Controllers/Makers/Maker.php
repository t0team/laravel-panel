<?php

namespace LazySoft\LaravelPanel\Controllers\Makers;

use Illuminate\Support\Facades\View;
use LazySoft\LaravelPanel\Traits\MakerTrait;

class Maker
{
    use MakerTrait;

    private $panel;
    protected array $data = [];

    protected function handle(array $config)
    {
        $this->panel = View::make("panel::index");
        $this->data['config'] = $config;

        $this->fixSidebarItems();
        $this->fixUserInfo();
    }

    private function fixSidebarItems()
    {
        $items = $this->data['config']['items'];

        foreach ($items as $key => $item) {
            $url = route($key);
            $newItems[$url] = (object) [
                'name' => $item['name'],
                'icon' => $item['icon'],
                'active' => in_array(request()->route()->getName(), [$key, ...$item['activeIn']]),
            ];
        }

        $this->data['items'] = $newItems;
    }

    private function fixUserInfo()
    {
        if (!auth()->check()) {
            return;
        }
        $user = auth()->user();
        $params = $this->data['config']['user'];

        // get all params
        foreach (explode(',', $params['name']) as $item) {
            $names[] = $user->$item;
        }

        $this->changeUserInfo(
            implode(' ', $names) ?? null,
            $user->{$params['side']} ?? null,
            $user->{$params['email']} ?? null,
            $user->{$params['image']} ?? null
        );
    }
}
