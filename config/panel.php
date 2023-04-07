<?php

use LazySoft\LaravelPanel\Controllers\ExampleController;

return [

    /*
    |--------------------------------------------------------------------------
    | Panel Title & Theme Color (hex type)
    |--------------------------------------------------------------------------
    */

    'title' => "پنل مدیریت",
    'theme' => "#2962ff",

    /*
    |--------------------------------------------------------------------------
    | Panel Logout
    |--------------------------------------------------------------------------
    |
    | This option defines the route name for logout button.
    | You can use post or get method.
    |
    */

    'logout' => [
        'route' => 'logout',
        'method' => 'post',
    ],

    /*
    |--------------------------------------------------------------------------
    | Panel User Info
    |--------------------------------------------------------------------------
    |
    | This option defines the user info for panel.
    | Get user info from auth()->user() if login.
    | You can use multiple params like this: 'first_name,last_name', only for name.
    | if not found any param, set null
    |
    */

    'user' => [
        'name' => 'name,lastname',
        'side' => "email",
        'image' => 'image',
        'email' => "email",
    ],

    /*
    |------------------------------- -------------------------------------------
    | Panel Items
    |--------------------------------------------------------------------------
    |
    | This option defines the items for panel sidebar.
    | Route is the button address, and you can use [route name] as route.
    | Also you can set name, icon, and activeIn,
    | Icon is from fontawesome6 icon.
    | activeIn is an array of route names + route that the button will be active in.
    |
    | In badge you can set action, value, and color.
    | Action call a method from a controller, like [ExampleController::class, 'badge']
    | Value is a static value like 'beta', Priority is lower than action.
    | Color is a bootstrap color, like 'primary'
    |
    */

    'items' => [
        [
            'route' => 'welcome',
            'name' => 'داشبورد',
            'icon' => 'fa-light fa-home-lg-alt',
            'activeIn' => ['welcome'],

            'badge' => [
                'action' => [ExampleController::class, 'badge'],
                // 'value' => 5,
                'color' => 'danger',
            ],
        ],
    ],
];
