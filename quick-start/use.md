---
label: Start Using
icon: plus-circle
---
# Start Using
before you start using the package, you must [install](/quick-start/installation) and [configure](/quick-start/configuration) it.

---

## Create Route
For each page in panel you must create a route.
For example, we want to create a page for index users. So we must create a route for it.

```php
// routes/web.php

Route::get('users', "UsersController@index");
```

## Create View
For each route you must create a view.
For example, we want to create a page for index users. So we must create a view for it.

```php
// resources/views/users/index.blade.php

@foreach($users as $user)
    {{ $user->name }}
@endforeach
```

## Show View in Panel
For show view in panel, You must:

```php
// app/Http/Controllers/UsersController.php

use LazySoft\LaravelPanel\Facades\Panel;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return Panel::makeView('users.index')
            ->with('users', $users)
            ->render();
    }
}
```

See also [Make View](/features/make-view) for more information.
