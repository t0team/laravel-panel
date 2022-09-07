---
icon: dot
order: 100
label: Make View
---

## Start Show View
For show view in panel, You must:

```php
use LazySoft\LaravelPanel\Facades\Panel;

$panel = Panel::view('users.index');
```

## Add Data
You can add data to view by `with` method:

```php
$panel->with(compact('users'));
// or
$panel->with('users', $users);
```

## Set Page Title
You can set title for page by `title` method.

```php
$panel->title('titleName');
```

## Set Page Button
You can add button to page by `button` method:

```php
$panel->button(
    'buttonText',
    'route name or url',
    'icon', # from fontawesome v6
    'variant', # primary, secondary, success, danger, warning, info, light, dark
    'outline', # true or false
    'openInNewTab', # true or false
);
```

## Change User Info
You can change user info by `changeUserInfo` method:

```php
$panel->changeUserInfo(
    'name' => 'user name',
    'side' => 'admin', // user side or username
    'email' => 'email address',
    'image' => 'avatar url',
);
```

## Render View
You can render view by `render` method:

```php
return $panel->render();
```