<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use T0team\LaravelPanel\Controllers\Form\Group;
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

class FormMaker extends Maker
{
    private array $form = [];
    private array $groups = [];

    public function make(string $routeNameOrUrl, array $routeNeeded, string $method): static
    {
        if ($this->isUrl($routeNameOrUrl)) {
            $this->form['url'] = $routeNameOrUrl;
        } else {
            $this->form['url'] = route($routeNameOrUrl, $routeNeeded);
        }

        if ($method == 'GET') {
            $this->form['form_method'] = 'GET';
            $this->form['laravel_method'] = 'GET';
        } else {
            $this->form['form_method'] = 'POST';
            $this->form['laravel_method'] = $method;
        }

        return $this;
    }


    public function group(Group $group): FormMaker
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

    /** return the view of the form */
    public function toView()
    {
        return view('panel::form.index', [
            'form' => (object)$this->form,
            'groups' => $this->groups,
        ]);
    }

    protected function beforeRender()
    {
        $this->data['view'] = $this->toView();
    }
}
