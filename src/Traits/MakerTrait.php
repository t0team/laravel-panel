<?php

namespace T0team\LaravelPanel\Traits;

trait MakerTrait
{
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
        if ($this->isUrl($routeNameOrUrl)) {
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

    protected function isUrl(string $url): bool
    {
        return strpos($url, 'http') !== false;
    }

    protected function beforeRender()
    {
    }

    public function render()
    {
        $this->beforeRender();

        $this->panel->with($this->data);

        return $this->panel->render();
    }
}
