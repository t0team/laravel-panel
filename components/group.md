---
icon: archive
order: 99
label: Group
---

in this section, we explain how to use `Group` class to create a group in panel.

## Use `Group` Class From:

```php
use T0team\LaravelPanel\Controllers\Form\Group;
```

## Start Using `Group` Class

```php
$group = Group::make('group name');
```

----
## Group Methods

### Add Input

```php
$group->addInput(Input::make('input name')->...);
#or
$group->addInputs($inputs);
```

!!!info
See [Input](/components/input) guide to know how to use `Input` class.
!!!

### Set Col 
You can set col up to 12.

```php
$group->col(6);
```

### Set Mobile Col
You can set mobile col up to 12.

```php
$group->colMobile(6);
```

### Set Tablet Col
You can set tablet col up to 12.

```php
$group->colTablet(6);
```

### Set Laptop Col
You can set laptop col up to 12.

```php
$group->colLaptop(6);
```

### Set Desktop Col
You can set desktop col up to 12.

```php
$group->colDesktop(6);
```




