<?php

use T0team\LaravelPanel\Controllers\ExampleController;
use T0team\LaravelPanel\Enums\Color;

return [

    /*
    |--------------------------------------------------------------------------
    | Panel Config
    |--------------------------------------------------------------------------
    |
    | This option defines the panel config.
    | You can set title, direction and theme.
    | direction can be 'ltr' (left to right) or 'rtl' (right to left)
    | theme can be hex color code.
    | font can be 'nunito' or 'dana'
    */

    'title' => "Panel",
    'direction' => 'ltr',
    'theme' => "#2962ff",
    'font' => "nunito",

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
    |--------------------------------------------------------------------------
    | Panel Top Badge
    |--------------------------------------------------------------------------
    |
    | This option defines the badge for panel top.
    | You can set name, value, after, and color.
    | After is a string after value, like '$'.
    | colors is From Color Enum.
    |
    */

    'badge' => [
        'active' => true,
        'title' => 'Wallet:',
        'value' => [ExampleController::class, 'count'],
        'after' => '$',

        'color' => [
            'background' => Color::SUCCESS,
            'text' => Color::LIGHT,
            'value' => Color::DARK,
        ],
    ],

    /*
    |------------------------------- -------------------------------------------
    | Panel Items
    |--------------------------------------------------------------------------
    |
    | This option defines the items for panel sidebar.
    | You can use multiple key type: group, item, module
    | If you use module, you can set module in params.
    | Also you can set route, name, icon, and activeIn,
    | Icon is from fontawesome6 icon.
    | activeIn is an array of route names + route that the button will be active in.
    |
    | In badge you can set action, value, and color.
    | Action call a method from a controller, like [ExampleController::class, 'badge']
    | Value is a static value like 'beta', Priority is lower than action.
    | Color is From Color Enum, default is danger.
    |
    */

    'sidebar' => [
        [
            'item' => 'Dashboard',
            'route' => 'welcome',
            'icon' => 'fa-light fa-home-lg-alt',
            'activeIn' => ['welcome'],

            'badge' => [
                'action' => [ExampleController::class, 'badge'],
                // 'value' => 5,
                'color' => Color::DANGER,
            ],
        ],

        // [
        //     'module' => 'TestModule',
        // ],

        // [
        //     'group' => 'Test Group',
        //     'icon' => 'fa-light fa-home-lg-alt',
        //     'items' => [
        //         [
        //             'item' => 'Dashboard',
        //             'url' => 'http://localhost',
        //             'route' => 'welcome',
        //             'newTab' => false,
        //             'icon' => 'fa-light fa-home-lg-alt',
        //             'activeIn' => ['welcome'],
        //         ],
        //     ],
        // ]
    ],
];
