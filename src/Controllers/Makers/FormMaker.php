<?php

namespace LazySoft\LaravelPanel\Controllers\Makers;

use LazySoft\LaravelPanel\Controllers\Form\Input;

class FormMaker extends Maker
{
    private array $form = [];
    private array $inputs = [];

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

    public function addInput(Input $input): FormMaker
    {
        $this->inputs[] = $input->get();

        return $this;
    }

    public function addInputs(array $inputs): FormMaker
    {
        foreach ($inputs as $input) {
            $this->addInput($input);
        }

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
            'inputs' => $this->inputs,
        ]);
    }
}
