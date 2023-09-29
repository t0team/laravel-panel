<?php

namespace T0team\LaravelPanel\Traits;

use T0team\LaravelPanel\Controllers\Button;

trait MakerTrait
{
    public function title(string $title): static
    {
        if ($title != null && $title != '') {
            $this->data['title'] = $title;
        }

        return $this;
    }

    public function button(Button $button): static
    {
        $this->data['button'] = $button->get();

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
