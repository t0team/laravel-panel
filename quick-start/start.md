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

## Use Panel Facade in Controller
Now we must use `Panel` facade in controller to create a page.

```php
// app/Http/Controllers/UsersController.php

use T0team\LaravelPanel\Facades\Panel;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $panel = Panel::table([
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ]);

        $panel->paginate(User::paginate(10));

        return $panel->render();
    }
}
```

See also [Make View](/features/make-view) for more information.
