<?php

// config for Fuelviews/Navigation
return [
    'navigation' => [
        [
            'type' => 'link',
            'position' => 0,
            'name' => 'Home',
            'route' => 'home',
        ],
        [
            'type' => 'link',
            'position' => 3,
            'name' => 'Our Work',
            'route' => 'home2',

        ],
        [
            'type' => 'link',
            'position' => 2,
            'name' => 'Contact Us',
            'route' => 'test',
        ],
        [
            'type' => 'dropdown',
            'position' => 1,
            'name' => 'About',
            'links' => [
                [
                    'name' => 'Our Team',
                    'route' => 'welcome',
                ],
                [
                    'name' => 'Our Warranty',
                    'route' => 'welcome',
                ],
                [
                    'name' => 'Our Reviews',
                    'route' => 'welcome',
                ],
                [
                    'name' => 'Trusted Vendors',
                    'route' => 'welcome',
                ],
            ],
        ],
        [
            'type' => 'dropdown',
            'position' => 4,
            'name' => 'Locations',
            'links' => [
                [
                    'name' => 'Texas',
                    'route' => 'test2',
                    'params' => [
                        'state_slug' => 'texas',
                    ],
                ],
                [
                    'name' => 'Plano',
                    'route' => 'test2',
                    'params' => [
                        'state_slug' => 'texas',
                        'city_slug' => 'plano',
                    ],
                ],
                [
                    'name' => 'Denton',
                    'route' => 'test2',
                    'params' => [
                        'state_slug' => 'texas',
                        'city_slug' => 'denton',
                    ],
                ],
                [
                    'name' => 'Southlake',
                    'route' => 'test2',
                    'params' => [
                        'state_slug' => 'texas',
                        'city_slug' => 'southlake',
                    ],
                ],
            ],
        ],
    ],

    'default_logo' => 'images/stp-logo-2xl.png',
    'transparency_logo' => 'images/stp-logo-white-2xl.png',

    'phone' => '(940) 205-8956',

    'top_nav_enabled' => false,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,
];
