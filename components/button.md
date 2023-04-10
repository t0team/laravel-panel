---
icon: diamond
order: 100
label: Button
---

in this section, we explain how to use `Button` class to create a button in panel.

## Use `Button` Class From:

```php
use T0team\LaravelPanel\Controllers\Button;
```

## Start Using `Button` Class

```php
$button = Button::make();
```

!!!warning Button Actions
If you don't use any button action, button will not work. (see [Button Actions](/components/button#button-actions))
!!!

----
## Button Methods

### Set Label

```php
$button->label('button label');
```

### Set Icon

Icon name is from [Font Awesome](https://fontawesome.com/icons) icons.

```php
$button->icon('icon name');
```

### Set Color

You must use `Color` enum to set button color.

```php
use T0team\LaravelPanel\Enums\Color;

$button->color(Color::PRIMARY);
```

### Set Size

You must use `Size` enum to set button size.

```php
use T0team\LaravelPanel\Enums\Size;

$button->size(Size::SMALL);
```

### Set Outline

```php
$button->outLine();
```

### Set Open In New Tab
```php
$button->openInNewTab();
```

### Set Disabled

```php
$button->disabled();
```

### Set Hidden

```php
$button->hidden();
```

### Set Rel
    
```php  
$button->rel('rel value');
```

### Set Custom Target

```php
$button->target('target value');
```

----
## Button Actions

### Open Url

```php
$button->url('url');
```

### Open Route

```php 
$button->route('route name', ['route needed parameters']);
```

### Open Modal

```php
$button->modal(Modal::make()->...);
```

!!!info
See [Modal](/components/modal) guide to know how to use `Modal` class.
