---
icon: eye
order: 99
label: Make View
---

## Start Show View
For show a view in panel, You must:

```php
use T0team\LaravelPanel\Facades\Panel;

$panel = Panel::view('welcome');
```

## Add Data
You can add data to view by `with` method:

```php
$panel->with(compact($data));
// or
$panel->with('data', $data);
```

## Render View
You can render view by `render` method:

```php
return $panel->render();
```
----

## Other Methods

Also you can use all methods of [Panel Facade](/features/panel-facade) in this section.
