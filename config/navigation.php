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

    // dropdown blog links
    [
        'type' => 'dropdown-blog',
        'position' => 2,
        'name' => 'Blog',
        'enabled' => false,
    ],

    // scrolled routes
    'pre_scrolled_routes' => [
        'careers',
        'contact',
        'forms.thank-you',
    ],

    // phone config
    'phone' => config('business-info.phone') ?: '(666) 666-6666',

    // logo config
    'default_logo' => '',
    'transparency_logo' => '',

    // navigation config
    'top_nav_enabled' => false,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,

    // footer stuff, needs to be moved to navigation config
    'logo_shape' => 'horizontal', // Can be 'horizontal', 'vertical', or 'square'
];
