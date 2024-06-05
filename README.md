# This is my package laravel-navigation

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

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
    'navigation' => [
        // Define your navigation items here
        ['route' => 'home', 'label' => 'Home', 'position' => 1],
        ['route' => 'about', 'label' => 'About', 'position' => 2],
        // Add more items as needed
    ],
    'default_logo' => 'path/to/default/logo.png',
    'transparency_logo' => 'path/to/transparency/logo.png',
    'phone' => '1-800-123-4567',
    'top_nav_enabled' => true,
    'logo_swap_enabled' => true,
    'transparent_nav_background' => true,
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-navigation-views"
```

## Usage

```php

```

## Tailwindcss classes

Add laravel-form to your tailwind.config.js file.

```javascript
    content: [
        './vendor/fuelviews/laravel-navigation/resources/**/*.{js,vue,blade.php}',
    ]
```

## Changelog

Please see [CHANGELOG](../laravel-middleware/CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [thejmitchener](https://github.com/thejmitchener)
- - [Fuelviews](https://github.com/fuelviews)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
