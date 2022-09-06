<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Panel Title
    |--------------------------------------------------------------------------
    */

    'title' => "پنل مدیریت",

    /*
    |--------------------------------------------------------------------------
    | Panel Logout Route
    |--------------------------------------------------------------------------
    |
    | This option defines the route name for logout button.
    |
    */

    'logoutRoute' => 'logout',

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
    | Key is the button address, and you can use [route name] as key.
    | In params you can set name, icon, and activeIn,
    | Icon is from fontawesome6 icon.
    | activeIn is an array of route names + key that the button will be active in.
    |
    */

    'items' => [
        'welcome' => [
            'name' => 'داشبورد',
            'icon' => 'fa-light fa-home-lg-alt',
            'activeIn' => ['welcome'],
        ],
    ],
];
