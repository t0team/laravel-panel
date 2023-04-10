---
icon: package
order: 100
label: Panel Facade
---

in this section, we explain how to use `Panel` facade to create a page in panel.

### Use `Panel` Facade From:

```php
use T0team\LaravelPanel\Facades\Panel;
```

### You Can Use `Panel` Facade To:

-   make a view (see [Make View](/features/make-view))
-   make a table (see [Make Table](/features/make-table))
-   make a form (see [Make Form](/features/make-form))


----
## Common Methods

### Set Page Title

You can set title for page by `title` method.

```php
$panel->title('titleName');
```

### Set Page Button

You can add button to header of page by `button` method:
</br>
header button build with `Button` class.

```php
use T0team\LaravelPanel\Controllers\Button;

$panel->button(Button::make()->label('buttonText')->...);
```

### Custom User Info

You can set custom user info by `changeUserInfo` method:
```php
$panel->changeUserInfo([
    'name' => 'user name',
    'side' => 'admin', // user side or username
    'email' => 'email address',
    'image' => 'avatar url',
]);
```

### Render View

You can render page by `render` method:

```php
return $panel->render();
```
