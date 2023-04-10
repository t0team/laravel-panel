---
icon: table
order: 98
label: Make Table
---

## Start Make a Table
For make a table in panel, You must:

```php
use T0team\LaravelPanel\Facades\Panel;

$headers = [
    'id' => 'ID',
    'name' => 'Name',
    'email' => 'Email',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
# keys of $headers array is key name of data(rows)
# values of $headers array is title of column in table

$panel = Panel::table($headers);
```

### Add Header
You can add header to table by `addHeader` & `addHeaders` methods:
!!!warning
These Items are added to the end of the previous items
!!!

```php
$panel->addHeader('id', 'ID');
# or
$panel->addHeaders(['id' => 'ID', 'name' => 'Name'])
```

## Add Row
You can add rows to table by `addRow` & `addRows` methods:

```php
$panel->addRow($user);
# or
$panel->addRows($users);
```

## Use with paginate
You can use with paginate by `paginate` method:

!!!warning
This method is remove all rows and add new rows with paginate
!!!

```php
$panel->paginate(User::paginate(10));
```

## Add Action Button
You can add action button to each row by `addAction` method:
</br>
action button build with `Button` class.

```php
use T0team\LaravelPanel\Controllers\Button;

$panel->addAction(Button::make()->label('buttonText')->...);
```

## Render Table
You can render table by `render` method:

```php
return $panel->render();
```

----
## Other Methods

Also you can use all methods of [Panel Facade](/features/panel-facade) in this section.