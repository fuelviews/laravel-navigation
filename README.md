# Laravel navigation package


## Installation

You can install the package via composer:

```bash
composer require fuelviews/laravel-navigation
```

You can publish and run the migrations with:

You can publish the config file with:

```bash
php artisan vendor:publish --tag="navigation-config"
```

This is the contents of the published config file:

```php
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
                ]
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
```

Optionally, you can publish the default logo using:

```bash
php artisan vendor:publish --tag="navigation-logo"
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="navigation-views"
```

Optionally, you can publish the spacer view using:

```bash
php artisan vendor:publish --tag="navigation-spacer"
```

## Usage

```php
<x-navigation::navigation />
<x-navigation::spacer />
```

## Tailwindcss classes

Add laravel-forms to your tailwind.config.js file:

```javascript
    content: [
        './vendor/fuelviews/laravel-navigation/resources/**/*.{js,vue,blade.php}',
    ]
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Thejmitchener](https://github.com/thejmitchener)
- [Fuelviews](https://github.com/fuelviews)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
