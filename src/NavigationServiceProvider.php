<?php

namespace Fuelviews\Navigation;

use Fuelviews\Navigation\Commands\NavigationInstallCommand;
use Fuelviews\Navigation\View\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\View\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\View\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\View\Components\NavigationScroll;
use Fuelviews\Navigation\View\Components\Spacer;
use Fuelviews\Navigation\View\Components\TopBar;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NavigationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('navigation')
            ->hasConfigFile('navigation')
            ->hasViews('navigation')
            ->hasViewComponents('navigation', NavigationScroll::class, TopBar::class)
            ->hasCommand(NavigationInstallCommand::class);
    }

    public function bootingPackage(): void
    {
        Blade::component('navigation::mobile.mobile-navigation', MobileNavigation::class);
        Blade::component('navigation::desktop.desktop-navigation', DesktopNavigation::class);
        Blade::component('navigation::desktop.desktop-dropdown-button', DesktopDropdownButton::class);
        Blade::component('navigation::components.spacer', Spacer::class);

        $sourcePath = __DIR__.'/../resources/views/components/spacer.blade.php';
        $this->publishes([
            $sourcePath=> resource_path('views/vendor/navigation/components/spacer.blade.php'),
        ], 'navigation-spacer');

        $sourcePath2 = __DIR__.'/../public/images';
        $this->publishes([
            $sourcePath2 => public_path('images'),
        ], 'navigation-logo');
    }
}
