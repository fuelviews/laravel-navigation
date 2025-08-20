# Laravel Navigation Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fuelviews/laravel-navigation.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-navigation)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions/workflows/run-tests.yml?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fuelviews/laravel-navigation/php-cs-fixer.yml?label=code%20style&style=flat-square)](https://github.com/fuelviews/laravel-navigation/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/fuelviews/laravel-navigation.svg?style=flat-square)](https://packagist.org/packages/fuelviews/laravel-navigation)
[![PHP Version](https://img.shields.io/badge/PHP-^8.3-blue.svg?style=flat-square)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-^10|^11|^12-red.svg?style=flat-square)](https://laravel.com)

A comprehensive and flexible Laravel navigation package that provides beautiful, responsive navigation components with Alpine.js interactions and Tailwind CSS styling. Perfect for building modern Laravel applications with professional navigation experiences.


## 📋 Requirements

- PHP 8.3+
- Laravel 10.x, 11.x, or 12.x
- Livewire
- Tailwind CSS

## 🚀 Installation
Install the package via Composer:

```bash
composer require fuelviews/laravel-navigation
```

### Quick Setup

Run the install command for guided setup:

```bash
php artisan navigation:install
```

This will:
- Publish the configuration file
- Publish view files for customization
- Provide setup instructions

### Manual Setup

Alternatively, you can manually publish components:

```bash
# Publish configuration
php artisan vendor:publish --tag="navigation-config"

# Publish views (optional)
php artisan vendor:publish --tag="navigation-views"

# Publish service provider for advanced customization (optional)
php artisan vendor:publish --tag="navigation-provider"
```

## ⚙️ Configuration

The package uses a comprehensive configuration file located at `config/navigation.php`:

### Navigation Items

Define your navigation structure with support for simple links and dropdown menus:

```php
'navigation' => [
    // Simple link
    [
        'type' => 'link',
        'position' => 0,
        'name' => 'Home',
        'route' => 'home',
    ],
    
    // Dropdown menu
    [
        'type' => 'dropdown',
        'position' => 1,
        'name' => 'Services',
        'links' => [
            [
                'name' => 'Web Development',
                'route' => 'services.web',
            ],
            [
                'name' => 'Mobile Apps',
                'route' => 'services.mobile',
            ],
        ],
    ],
],
```

### Visual Configuration

```php
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
```

### Pre-scrolled Routes

Define routes that should have a "scrolled" appearance from page load:

```php
'pre_scrolled_routes' => [
    'careers',
    'contact',
    'services',
    'forms.*',
    'sabhero-blog.*',
],
```

## 🧩 Components

### Desktop Navigation

```blade
<!-- Complete desktop navigation -->
<x-navigation::desktop.desktop-navigation />

<!-- Individual dropdown button -->
<x-navigation::desktop.desktop-dropdown-button 
    name="Services" 
    :links="$serviceLinks" 
/>
```

### Mobile Navigation

```blade
<!-- Mobile navigation menu -->
<x-navigation::mobile.mobile-navigation />

<!-- With custom background classes -->
<x-navigation::mobile.mobile-navigation 
    :bg-class="['bg-blue-50', 'bg-blue-100']" 
/>
```

### Navigation Wrapper

```blade
<!-- Smart navigation that adapts based on route -->
<x-navigation::navigation-scroll />

<!-- With transparency control -->
<x-navigation::navigation-scroll :is-transparent="false" />
```

### Utility Components

```blade
<!-- Top bar for contact info -->
<x-navigation::top-bar />

<!-- Footer with navigation links -->
<x-navigation::footer.footer />

<!-- Spacing component -->
<x-navigation::spacer />

<!-- Phone button -->
<x-navigation::phone-button />

<!-- Logo component -->
<x-navigation::logo />

<!-- Social media icons -->
<x-navigation::social.facebook />
<x-navigation::social.instagram />
<x-navigation::social.linkedin />
<x-navigation::social.youtube />
```

## 🎯 Complete Navigation Example

Here's a complete navigation setup:

```blade
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Your head content -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Top bar with contact info -->
    @if(Navigation::isTopNavEnabled())
        <x-navigation::top-bar />
    @endif
    
    <!-- Main navigation -->
    <x-navigation::navigation-scroll>
        <!-- Desktop navigation -->
        <div class="hidden md:flex">
            <x-navigation::logo />
            <x-navigation::desktop.desktop-navigation />
            <x-navigation::phone-button />
        </div>
        
        <!-- Mobile navigation toggle -->
        <div class="md:hidden">
            <x-navigation::hamburger-button />
        </div>
    </x-navigation::navigation-scroll>
    
    <!-- Mobile navigation menu -->
    <x-navigation::mobile.mobile-navigation />
    
    <!-- Page content -->
    <main>
        {{ $slot }}
    </main>
    
    <!-- Footer -->
    <x-navigation::footer.footer />
</body>
</html>
```

## 🎨 Styling with Tailwind CSS

Add the package views to your `tailwind.config.js`:

```javascript
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/fuelviews/laravel-navigation/resources/**/*.blade.php',
    ],
    // ... rest of your config
}
```

## 🔧 Using the Navigation Facade

Access navigation data programmatically:

```php
use Fuelviews\Navigation\Facades\Navigation;

// Get all navigation items
$items = Navigation::getNavigationItems();

// Check if dropdown route is active
$isActive = Navigation::isDropdownRouteActive($dropdownLinks);

// Get configuration values
$logo = Navigation::getDefaultLogo();
$phone = Navigation::getPhone();
$isTransparent = Navigation::isTransparentNavBackground();

// Check route states
$isPreScrolled = Navigation::isPreScrolledRoute();
$preScrolledString = Navigation::getPreScrolledRoute(); // 'true' or 'false'
```

## 🛠️ Artisan Commands

### List Navigation Items

View all configured navigation items:

```bash
php artisan navigation:list
```

Output:
```
Navigation Items:

+----------+----------+---------+--------------+
| Position | Type     | Name    | Route/Links  |
+----------+----------+---------+--------------+
| 0        | link     | Home    | home         |
| 1        | dropdown | Services| 3 links      |
| 2        | link     | About   | about        |
+----------+----------+---------+--------------+
```

### Validate Configuration

Validate your navigation configuration:

```bash
php artisan navigation:validate
```

This command checks for:
- Required fields (type, position, name)
- Valid navigation types
- Route existence
- Duplicate positions
- Dropdown structure integrity

## 🎛️ Advanced Usage

### Custom Navigation Items

Add navigation items programmatically:

```php
// In a service provider
config([
    'navigation.navigation' => array_merge(
        config('navigation.navigation'),
        [
            [
                'type' => 'link',
                'position' => 99,
                'name' => 'Admin',
                'route' => 'admin.dashboard',
            ]
        ]
    )
]);
```

### Custom View Components

Extend the package with your own components:

```php
// Create custom component
class CustomNavigationLink extends Component
{
    public function render()
    {
        return view('components.custom-navigation-link');
    }
}

// Register in AppServiceProvider
Blade::component('custom-nav-link', CustomNavigationLink::class);
```

## 🧪 Testing

The package includes comprehensive tests. Run them with:

```bash
# In the package directory
composer test

# Code style
composer format
```

### Testing Your Navigation

Test navigation in your application:

```php
// Feature test example
public function test_navigation_renders_correctly()
{
    $response = $this->get('/');
    
    $response->assertSeeLivewire(DesktopNavigation::class);
    $response->assertSee('Home');
    $response->assertSee('Services');
}
```

## 🎨 Customization Examples

### Custom Dropdown Styling

```blade
<!-- Override dropdown component -->
<x-navigation::desktop.desktop-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="custom-dropdown-button">
            Services
        </button>
    </x-slot>
    
    <x-slot name="content">
        <!-- Custom dropdown content -->
    </x-slot>
</x-navigation::desktop.desktop-dropdown>
```

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Development Setup

```bash
git clone https://github.com/fuelviews/laravel-navigation.git
cd laravel-navigation
composer install
composer test
```

## 📄 Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## 🔐 Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## 👨‍💻 Credits

- [Joshua Mitchener](https://github.com/thejmitchener)
- [Sweatybreeze](https://github.com/sweatybreeze)
- [Fuelviews](https://github.com/fuelviews)
- [All Contributors](../../contributors)

## 📜 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---

<div align="center">
    <p>Built with ❤️ by the <a href="https://fuelviews.com">Fuelviews</a> team</p>
    <p>
        <a href="https://github.com/fuelviews/laravel-navigation">⭐ Star us on GitHub</a> •
        <a href="https://packagist.org/packages/fuelviews/laravel-navigation">📦 View on Packagist</a>
    </p>
</div>
