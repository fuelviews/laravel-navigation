<?php

use Fuelviews\Navigation\NavigationServiceProvider;
use Fuelviews\Navigation\Components\Desktop\DesktopDropdownButton;
use Fuelviews\Navigation\Components\Desktop\DesktopNavigation;
use Fuelviews\Navigation\Components\Footer\Footer;
use Fuelviews\Navigation\Components\Mobile\MobileNavigation;
use Fuelviews\Navigation\Components\NavigationScroll;
use Fuelviews\Navigation\Components\Spacer;
use Fuelviews\Navigation\Components\TopBar;
use Spatie\LaravelPackageTools\Package;

test('it configures the package correctly', function () {
    // Create a mock of the Package class
    $package = Mockery::mock(Package::class);

    // Set up expectations for the package configuration
    $package->shouldReceive('name')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('hasConfigFile')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('hasViews')->with('navigation')->once()->andReturnSelf();
    $package->shouldReceive('publishesServiceProvider')->with('NavigationServiceProvider')->once()->andReturnSelf();
    $package->shouldReceive('hasViewComponents')
        ->withArgs([
            'navigation',
            NavigationScroll::class,
            TopBar::class,
            Footer::class,
            MobileNavigation::class,
            DesktopNavigation::class,
            DesktopDropdownButton::class,
            Spacer::class,
        ])
        ->once()
        ->andReturnSelf();
    $package->shouldReceive('hasCommand')->twice()->andReturnSelf();
    $package->shouldReceive('hasInstallCommand')->once()->andReturnSelf();
    $package->shouldReceive('sharesDataWithAllViews')->once()->andReturnSelf();

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
