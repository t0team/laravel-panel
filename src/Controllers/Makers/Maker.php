<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Contracts\View\View as ViewContracts;
use Illuminate\Support\Facades\View;
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Traits\MakerTrait;

class Maker
{
    use MakerTrait;

    private ViewContracts $panel;
    protected array $data = [];

    protected function handle(array $config)
    {
        $this->panel = View::make("panel::index");
        $this->data['config'] = $config;

        $this->fixSidebarItems();
        $this->fixUserInfo();
        $this->handleTheme();
    }

    private function fixSidebarItems()
    {
        $items = $this->data['config']['sidebar'];

        foreach ($items as $data) {
            $item = match ($data['type'] ?? 'item') {
                'module' => $this->handleSidebarModule($data['module']),
                'item' => $this->handleSidebarItem($data),
                default => throw new \Exception("Invalid sidebar item type: [{$data['type']}]"),
            };

            if (!is_null($item)) {
                $this->data['items'][] = $item;
            }
        }
    }

    private function handleSidebarModule(string $name): object|null
    {
        // check application use modules
        if (!class_exists(\Nwidart\Modules\Facades\Module::class)) {
            return null;
        }

        // check module is installed
        $module = \Nwidart\Modules\Facades\Module::find($name);
        if (!$module) throw new \Exception("Module [{$name}] not found");

        // check module is enabled
        if (!$module->isEnabled()) return null;

        // check module has panel config
        $data = config("{$module->getLowerName()}.panel");
        if (is_null($data)) return null;


        // get route url
        $url = route($data['route']);

        // check module has badge
        if (isset($data['badge'])) {
            $badge = $this->handleBadge($data['badge']);
        }

        return (object) [
            'url' => $url,
            'name' => $data['name'],
            'icon' => $data['icon'],
            'active' => in_array(request()->route()->getName(), [$data['route'], ...$data['activeIn'] ?? []]),
            'badge' => $badge ?? false,
        ];
    }

    private function handleSidebarItem(array $item): object
    {
        // get route url
        $url = route($item['route']);

        // check module has badge
        if (isset($item['badge'])) {
            $badge = $this->handleBadge($item['badge']);
        }

        return (object) [
            'url' => $url,
            'name' => $item['name'],
            'icon' => $item['icon'],
            'active' => in_array(request()->route()->getName(), [$item['route'], ...$item['activeIn'] ?? []]),
            'badge' => $badge ?? false,
        ];
    }

    private function handleBadge(array $badge): bool|object
    {
        // check available color
        $color = $badge['color'] ?? 'danger';
        Color::is_available_color($color) || throw new \Exception("Badge Color not available In [" . Color::class . "]");

        if (method_exists($badge['action'][0] ?? '', $badge['action'][1] ?? '')) {
            return (object) [
                'value' => app($badge['action'][0])->{$badge['action'][1]}(),
                'color' => $color,
            ];
        }

        if (isset($badge['value'])) {
            return (object) [
                'value' => $badge['value'],
                'color' => $color,
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

    private function handleTheme()
    {
        $theme = $this->data['config']['theme'] ?? "#2962ff";
        $theme = str_replace('#', '', $theme);

        sscanf($theme, "%02x%02x%02x", $r, $g, $b);

        $this->data['theme'] = "{$r} {$g} {$b}";
    }
}
