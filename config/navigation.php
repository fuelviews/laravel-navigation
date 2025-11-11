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

        // single link
        /*[
            'type' => 'link',
            'position' => 6,
            'name' => 'Articles',
            'route' => 'sabhero-articles.post.index',
        ],*/
    ],

    // scrolled routes
    'pre_scrolled_routes' => [
        'careers',
        'contact',
        'services',
        'forms.*',
        'sabhero-articles.*',
        'portfolio',
        'privacy-policy',
        'terms-and-conditions',
    ],

    // phone config
    'phone' => config('business-info.phone')
        ?: '(777) 777-7777',

    // logo config
    'default_logo' => '',
    'transparency_logo' => '',

    // navigation config
    'top_nav_enabled' => false,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,

    // logo shape config: 'horizontal', 'vertical', or 'square'
    'default_logo_shape' => 'square',
    'transparency_logo_shape' => 'horizontal',
];
