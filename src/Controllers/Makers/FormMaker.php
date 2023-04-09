<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use T0team\LaravelPanel\Controllers\Form\Group;
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

class FormMaker extends Maker
{
    private array $form = [];
    private array $groups = [];

    public function __construct(string $routeNameOrUrl, array $routeNeeded, string $formMethod, string $laravelMethod, array $config)
    {
        $this->handle($config);

        if ($this->isUrl($routeNameOrUrl)) {
            $this->form['url'] = $routeNameOrUrl;
        } else {
            $this->form['url'] = route($routeNameOrUrl, $routeNeeded);
        }

        $this->form['form_method'] = $formMethod;
        $this->form['laravel_method'] = $laravelMethod;

        return $this;
    }

    public function addGroup(Group $group): FormMaker
    {
        $this->groups[] = $group->get();

        return $this;
    }

    public function submit(string $label, string $color = 'primary', string $size = 'md'): FormMaker
    {
        $this->form['submit'] = $label;

        Color::is_available_color($color) || throw new \Exception("Submit Color not available In [" . Color::class . "]");
        $this->form['submit_color'] = $color;

        Size::available_sizes($size) || throw new \Exception("Submit Size not available In [" . Size::class . "]");
        $this->form['submit_size'] = $size;

        return $this;
    }

    public function reset(string $label = 'شروع دوباره', string $color = 'secondary', string $size = 'md'): FormMaker
    {
        $this->form['reset'] = $label;

        Color::is_available_color($color) || throw new \Exception("Reset Color not available In [" . Color::class . "]");
        $this->form['reset_color'] = $color;

        Size::available_sizes($size) || throw new \Exception("Reset Size not available In [" . Size::class . "]");
        $this->form['reset_size'] = $size;

        return $this;
    }

    protected function beforeRender()
    {
        $this->data['view'] = view('panel::form.index', [
            'form' => (object)$this->form,
            'groups' => $this->groups,
        ]);
    }
}
