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

            if (isset($item['badge'])) {
                $badge = $this->handleBadge($item['badge']);
            }

            $newItems[$url] = (object) [
                'name' => $item['name'],
                'icon' => $item['icon'],
                'active' => in_array(request()->route()->getName(), [$key, ...$item['activeIn']]),
                'badge' => $badge ?? false,
            ];
        }

        $this->data['items'] = $newItems;
    }

    private function handleBadge(array $badge): bool|object
    {
        if (method_exists($badge['action'][0] ?? '', $badge['action'][1] ?? '')) {
            return (object) [
                'value' => app($badge['action'][0])->{$badge['action'][1]}(),
                'color' => $badge['color'] ?? 'danger',
            ];
        }

        if (isset($badge['value'])) {
            return (object) [
                'value' => $badge['value'],
                'color' => $badge['color'] ?? 'danger',
            ];
        }

        return false;
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
