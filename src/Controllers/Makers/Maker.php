<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Contracts\View\View as ViewContracts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Traits\MakerTrait;

class Maker
{
    use MakerTrait;

    private ViewContracts $panel;
    protected Collection $data;

    public static function as(array $config): static
    {
        return new static(collect($config));
    }

    private function __construct(Collection $config)
    {
        $this->panel = View::make("panel::index");

        $this->data = collect([
            'config' => $config,
            'dir' => $config->get('direction', 'ltr'),
            'badge' => $config->get('badge'),
            'theme' => $this->getTheme($config->get('theme')),
            'user' => $this->getUserInfo($config->get('user')),
            'items' => $this->getSidebarItems($config->get('sidebar')),
        ]);
    }

    private function getTheme(?string $theme): string
    {
        $theme = $theme ?? "#2962ff";
        $theme = str_replace('#', '', $theme);

        sscanf($theme, "%02x%02x%02x", $r, $g, $b);

        return "{$r} {$g} {$b}";
    }

    private function getUserInfo(?array $params): ?object
    {
        if (!auth()->check()) return null;

        $user = auth()->user();

        return (object) [
            'name' => collect(explode(',', $params['name']))->map(fn ($i) => $user->{$i})->implode(' '),
            'side' => $user?->{$params['side']},
            'email' => $user?->{$params['email']},
            'image' => $user?->{$params['image']},
        ];
    }

    private function getSidebarItems(?array $items): array
    {
        return collect($items)
            ->map(function ($item) {
                return match (true) {
                    isset($item['group']) => $this->handleSidebarGroup($item),
                    isset($item['item']) => $this->handleSidebarItem($item),
                    isset($item['module']) => $this->handleSidebarModule($item['module']),

                    default => throw new \Exception("Sidebar should include [group, item, module] key."),
                };
            })
            ->filter()
            ->toArray();
    }

    private function handleSidebarGroup(array $data): ?object
    {
        $items = $this->getSidebarItems($data['items']);
        return (object) [
            'group' => true,
            'name' => $data['group'],
            'icon' => $data['icon'],
            'active' => collect($items)->pluck('active')->contains(true),
            'items' => $items,
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
            'name' => $item['item'],
            'icon' => $item['icon'],
            'active' => in_array(request()->route()->getName(), [$item['route'], ...$item['activeIn'] ?? []]),
            'badge' => $badge ?? false,
        ];
    }

    private function handleSidebarModule(string $name): ?object
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
}
