<?php

return [

    // navigation links config
    'navigation' => [

        // single link
        [
            'type' => 'link',
            'position' => 0,
            'name' => 'Welcome',
            'route' => 'welcome',
        ],

        // dropdown link
        [
            'type' => 'dropdown',
            'position' => 1,
            'name' => 'Welcome',
            'links' => [
                [
                    'name' => 'Welcome',
                    'route' => 'welcome',
                ],
                [
                    'name' => 'Welcome',
                    'route' => 'welcome',
                ],
            ],
        ],
    ],

    // logo config
    'default_logo' => 'images/logo.png',
    'transparency_logo' => 'images/logo.png',

    // phone config
    'phone' => '(666) 420-6969',

    // navigation config
    'top_nav_enabled' => false,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,
];
