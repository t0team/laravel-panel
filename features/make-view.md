---
icon: dot
order: 100
label: Make View
---

## Start Show View
For show view in panel, You must:

```php
use LazySoft\LaravelPanel\Facades\Panel;

$panel = Panel::makeView('users.index')
```

## Add Data
You can add data to view by `with` method:

```php
$panel->with('users', $users);
```

## Set Page Title
You can set title for page by `setPageTitle` method.

```php
$panel->setPageTitle('titleName');
```

## Set Page Button
You can add button to page by `setPageButton` method:

```php
$panel->setPageButton(
    'buttonText',
    'route name or url',
    'icon', # from fontawesome v6
    'variant', # primary, secondary, success, danger, warning, info, light, dark
    'outline', # true or false
    'openInNewTab', # true or false
);
```

## Change User Info
You can change user info by `setUserInfo` method:

```php
$panel->setUserInfo(
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