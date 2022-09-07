<?php

namespace LazySoft\LaravelPanel\Traits;

trait MakerTrait
{
    private function fixSidebarItems()
    {
        $items = $this->data['config']['items'];

        foreach ($items as $key => $item) {
            $url = route($key, [], false);
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

    public function changeUserInfo(string $name, string $userSide = null, string $email = null, string $image = null): self
    {
        $this->data['user'] = (object) [
            'name' => $name,
            'side' => $userSide,
            'email' => $email,
            'image' => $image,
        ];

        return $this;
    }

    public function title(string $title): self
    {
        if ($title != null && $title != '') {
            $this->data['title'] = $title;
        }

        return $this;
    }

    public function button(
        string $title,
        string $routeNameOrUrl,
        string $icon = null,
        string $color = 'primary',
        bool $outLine = false,
        bool $openInNewTab = false
    ): self {
        if (strpos($routeNameOrUrl, 'http') !== false) {
            $url = $routeNameOrUrl;
        } else {
            $url = route($routeNameOrUrl);
        }

        $this->data['button'] = (object) [
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'color' => $color,
            'outLine' => $outLine,
            'blanck' => $openInNewTab,
        ];

        return $this;
    }

    private function beforeRender()
    {
    }

    public function render()
    {
        $this->beforeRender();

        $this->panel->with($this->data);

        return $this->panel->render();
    }
}
