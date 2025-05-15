<?php

use Fuelviews\Navigation\NavigationServiceProvider;
use Fuelviews\Navigation\View\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\View\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\View\Components\Footer\Footer;
use Fuelviews\Navigation\View\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\View\Components\NavigationScroll;
use Fuelviews\Navigation\View\Components\Spacer;
use Fuelviews\Navigation\View\Components\TopBar;
use Spatie\LaravelPackageTools\Package;

test('it configures the package correctly', function () {
    // Create a mock of the Package class
    $package = Mockery::mock(Package::class);

    // Set up expectations for the package configuration
    $package->shouldReceive('name')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('hasConfigFile')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('hasViews')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('hasViewComponents')
        ->withArgs([
            'navigation',
            NavigationScroll::class,
            TopBar::class,
            Footer::class,
            MobileNavigation::class,
            DesktopNavigation::class,
            DesktopDropdownButton::class,
            Spacer::class
        ])
        ->once()
        ->andReturnSelf();

    // Create an instance of the service provider
    $serviceProvider = new NavigationServiceProvider(app());

    // Call the configurePackage method
    $serviceProvider->configurePackage($package);

    // Mockery will automatically verify that all expected methods were called
});

test('it registers the navigation singleton', function () {
    // Create an instance of the service provider
    $serviceProvider = new NavigationServiceProvider(app());

    // Register the service provider
    $serviceProvider->register();

    // Check if the Navigation singleton is registered
    expect(app()->bound('navigation'))->toBeTrue();
});

test('it registers the facade alias', function () {
    // Get the aliases registered by the service provider
    $aliases = (new NavigationServiceProvider(app()))->provides();

    // Check if the Navigation facade alias is registered
    expect($aliases)->toContain('navigation');
});
