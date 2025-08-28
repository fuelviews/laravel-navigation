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
            'route' => 'sabhero-article.post.index',
        ],*/
    ],

    // scrolled routes
    'pre_scrolled_routes' => [
        'careers',
        'contact',
        'services',
        'forms.*',
        'sabhero-article.*',
        'portfolio',
        'privacy-policy',
        'terms-and-conditions',
    ],

    // phone config
    'phone' => config('business-info.phone')
        ?: '(666) 666-6666',

    // logo config
    'default_logo' => '',
    'transparency_logo' => '',

    // navigation config
    'top_nav_enabled' => false,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,

    // logo shape config
    'default_logo_shape' => 'square', // Can be 'horizontal', 'vertical', or 'square'
    'transparency_logo_shape' => 'horizontal', // Can be 'horizontal', 'vertical', or 'square'
];
