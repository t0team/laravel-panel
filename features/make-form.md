---
icon: paper-airplane
order: 97
label: Make Form
---

## Start Make a Form
For make a form in panel, You must:

```php
use T0team\LaravelPanel\Facades\Panel;

$panel = Panel::form(
    'route name or url', // You can use route name in laravel or custom url
    'route needed' // When you use route name, maybe you need to pass some parameters to route
    'form method' // default is 'post', you can use 'get' or 'post'
    'laravel method' // default is 'post' you can use 'get', 'post', 'put', 'patch', 'delete'
);
```

## Add Form Group
First you must add a form group to form by `addGroup` method,
</br>
Then you can add inputs to group by `addInput` method:

```php
$panel->addGroup(
    Group::make('title')
        ->addInput(
            Input::text('name')
                ->label('label')
                ->...
        )
        ->...
);
```

!!!info
See [Group](/components/group) and [Input](/components/input) guide to know how to use `Group` and `Input` class.
!!!

## Custom Submit Button
You can customize submit button by `submit` method:


```php
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

$panel->submit(
    'label', // label of button
    Color::SUCCESS, // color of button, default is Color::PRIMARY
    Size::SMALL, // size of button, default is Size::MEDIUM
);
```

## Set Form Reset Button

You can set reset button by `reset` method:

```php
use T0team\LaravelPanel\Enums\Color;
use T0team\LaravelPanel\Enums\Size;

$panel->reset(
    'label', // label of button
    Color::DANGER, // color of button, default is Color::SECONDARY
    Size::SMALL, // size of button, default is Size::MEDIUM
);
```

----

## Other Methods

Also you can use all methods of [Panel Facade](/features/panel-facade) in this section.
