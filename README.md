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

Optionally, you can publish the logo view using:

```bash
php artisan vendor:publish --tag="navigation-logo"
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

- [Joshua Mitchener](https://github.com/thejmitchener)
- [Daniel Clark](https://github.com/sweatybreeze)
- [Fuelviews](https://github.com/fuelviews)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
