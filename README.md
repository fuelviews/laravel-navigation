# Laravel navigation package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fuelviews/laravel-navigation.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-navigation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions/workflows/run-tests.yml?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/php-cs-fixer.yml?label=code%20style&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/fuelviews/laravel-navigation.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-navigation)

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

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="navigation-views"
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
        './vendor/fuelviews/laravel-forms/resources/**/*.{js,vue,blade.php}',
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
- [Sweatybreeze](https://github.com/sweatybreeze)
- [Fuelviews](https://github.com/fuelviews)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
