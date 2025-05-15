<?php

namespace Fuelviews\Navigation;

use Fuelviews\Navigation\View\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\View\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\View\Components\Footer\Footer;
use Fuelviews\Navigation\View\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\View\Components\NavigationScroll;
use Fuelviews\Navigation\View\Components\Spacer;
use Fuelviews\Navigation\View\Components\TopBar;
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
            ->hasViewComponents(
                'navigation',
                NavigationScroll::class,
                TopBar::class,
                Footer::class,
                MobileNavigation::class,
                DesktopNavigation::class,
                DesktopDropdownButton::class,
                Spacer::class
            );
    }
}
