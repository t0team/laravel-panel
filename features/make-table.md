---
icon: dot
order: 99
label: Make Table
---

## Start Make a Table
For make a table in panel, You must:

```php
use LazySoft\LaravelPanel\Facades\Panel;

$headers = [
    'id' => 'ID',
    'name' => 'Name',
    'email' => 'Email',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
# keys of $headers array is key name of data(rows)
# values of $headers array is title of column

$panel = Panel::table($headers);
```


## Add Rows
You can add rows to table by `addRows` method:

```php
$users = User::all();

$panel->addRows($users);
```


## Add Row
You can add a row to table by `addRow` method:

```php
$user = User::find(1);

$panel->addRow($user);
```


## use with paginate
You can use with paginate by `withPaginate` method:

```php
$users = User::paginate(10);

$panel->withPaginate($users);
# This method also adds all rows with paginate
```


## add Action Button
You can add action button to table by `actionButton` method:

```php
$panel->addAction(
    'route name'
    'route parameters' # get value from row
    'button text',
    'icon', # from fontawesome v6
    'variant', # primary, secondary, success, danger, warning, info, light, dark
    'open in new tab', # true or false
);
```



---
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