<?php

namespace LazySoft\LaravelPanel\Controllers\Makers;

use LazySoft\LaravelPanel\Controllers\Form\Group;

class FormMaker extends Maker
{
    private array $form = [];
    private array $groups = [];

    public function __construct(string $routeNameOrUrl, string $formMethod, string $laravelMethod, array $config)
    {
        $this->handle($config);

        if ($this->isUrl($routeNameOrUrl)) {
            $this->form['url'] = $routeNameOrUrl;
        } else {
            $this->form['url'] = route($routeNameOrUrl);
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

    public function submit(string $label, string $color = 'primary'): FormMaker
    {
        $this->form['submit'] = $label;
        $this->form['submit_color'] = $color;

        return $this;
    }

    public function reset(string $label = 'شروع دوباره', string $color = 'danger'): FormMaker
    {
        $this->form['reset'] = $label;
        $this->form['reset_color'] = $color;

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
