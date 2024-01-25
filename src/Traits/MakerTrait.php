<?php

namespace T0team\LaravelPanel\Traits;

use T0team\LaravelPanel\Controllers\Button;

trait MakerTrait
{
    public function title(string $title): static
    {
        if ($title != null && $title != '') {
            $this->data->put('title', $title);
        }

        return $this;
    }

    public function button(Button $button): static
    {
        $this->data->put('button', $button->get());

        return $this;
    }

    public function script(string $script): static
    {
        $scripts = $this->data->get('scripts', []);

        $scripts[] = [
            'isUrl' => $this->isUrl($script),
            'content' => $script,
        ];

        $this->data->put('scripts', $scripts);

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

        $this->panel->with($this->data->toArray());

        return $this->panel->render();
    }
}
