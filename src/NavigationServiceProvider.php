<?php

namespace Fuelviews\Navigation;

use Fuelviews\Navigation\View\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\View\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\View\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\View\Components\NavigationScroll;
use Fuelviews\Navigation\View\Components\TopBar;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NavigationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-navigation')
            ->hasConfigFile('navigation')
            ->hasViews('navigation')
            ->hasViewComponents('navigation', NavigationScroll::class, TopBar::class);
    }

    public function bootingPackage(): void
    {
        Blade::component('navigation::mobile.mobile-navigation', MobileNavigation::class);
        Blade::component('navigation::desktop.desktop-navigation', DesktopNavigation::class);
        Blade::component('navigation::desktop.desktop-dropdown-button', DesktopDropdownButton::class);
    }
}
