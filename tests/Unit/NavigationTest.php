<?php

use Fuelviews\Navigation\Navigation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

test('getNavigationItems returns a collection', function () {
    Config::set('navigation.navigation', [
        [
            'name' => 'Home',
            'route' => 'home',
            'position' => 1,
            'type' => 'link',
        ],
        [
            'name' => 'About',
            'route' => 'about',
            'position' => 2,
            'type' => 'link',
        ],
    ]);

    $navigation = new Navigation(config('navigation', []));
    $items = $navigation->getNavigationItems();

    expect($items)->toBeInstanceOf(Collection::class);
    expect($items)->toHaveCount(2);
    expect($items[0]['name'])->toBe('Home');
    expect($items[1]['name'])->toBe('About');
});

test('getNavigationItems sorts items by position', function () {
    Config::set('navigation.navigation', [
        [
            'name' => 'About',
            'route' => 'about',
            'position' => 2,
            'type' => 'link',
        ],
        [
            'name' => 'Home',
            'route' => 'home',
            'position' => 1,
            'type' => 'link',
        ],
    ]);

    $navigation = new Navigation(config('navigation', []));
    $items = $navigation->getNavigationItems();

    expect($items[0]['name'])->toBe('Home');
    expect($items[1]['name'])->toBe('About');
});

test('isDropdownRouteActive returns true when current route matches a link in the dropdown', function () {
    $links = [
        ['route' => 'home'],
        ['route' => 'about'],
        ['route' => 'contact'],
    ];

    // Mock the Request facade with setUserResolver to avoid BadMethodCallException
    $requestMock = Mockery::mock('Illuminate\Http\Request');
    $requestMock->shouldReceive('routeIs')
        ->withArgs(function ($route) {
            return in_array($route, ['home', 'about', 'contact']);
        })
        ->andReturnUsing(function ($route) {
            return $route === 'about';
        });
    $requestMock->shouldReceive('setUserResolver')
        ->andReturn($requestMock);

    // Replace the request instance in the container
    app()->instance('request', $requestMock);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isDropdownRouteActive($links))->toBeTrue();
});

test('isDropdownRouteActive returns false when current route does not match any link in the dropdown', function () {
    $links = [
        ['route' => 'home'],
        ['route' => 'about'],
        ['route' => 'contact'],
    ];

    // Mock the Request facade with setUserResolver to avoid BadMethodCallException
    $requestMock = Mockery::mock('Illuminate\Http\Request');
    $requestMock->shouldReceive('routeIs')
        ->andReturn(false);
    $requestMock->shouldReceive('setUserResolver')
        ->andReturn($requestMock);

    // Replace the request instance in the container
    app()->instance('request', $requestMock);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isDropdownRouteActive($links))->toBeFalse();
});

test('getDefaultLogo returns the configured default logo', function () {
    Config::set('navigation.default_logo', 'default-logo.png');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getDefaultLogo())->toBe('default-logo.png');
});

test('getDefaultLogoShape returns the configured default logo shape', function () {
    Config::set('navigation.default_logo_shape', 'rounded');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getDefaultLogoShape())->toBe('rounded');
});

test('getTransparencyLogo returns the configured transparency logo', function () {
    Config::set('navigation.transparency_logo', 'transparent-logo.png');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getTransparencyLogo())->toBe('transparent-logo.png');
});

test('getPhone returns the configured phone number', function () {
    Config::set('navigation.phone', '123-456-7890');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getPhone())->toBe('123-456-7890');
});

test('isTopNavEnabled returns the configured top nav enabled status', function () {
    Config::set('navigation.top_nav_enabled', true);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isTopNavEnabled())->toBeTrue();

    Config::set('navigation.top_nav_enabled', false);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isTopNavEnabled())->toBeFalse();
});

test('isLogoSwapEnabled returns the configured logo swap enabled status', function () {
    Config::set('navigation.logo_swap_enabled', true);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isLogoSwapEnabled())->toBeTrue();

    Config::set('navigation.logo_swap_enabled', false);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isLogoSwapEnabled())->toBeFalse();
});

test('isTransparentNavBackground returns the configured transparent nav background status', function () {
    Config::set('navigation.transparent_nav_background', true);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isTransparentNavBackground())->toBeTrue();

    Config::set('navigation.transparent_nav_background', false);

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isTransparentNavBackground())->toBeFalse();
});

test('isPreScrolledRoute returns true when current route is in pre-scrolled routes', function () {
    Config::set('navigation.pre_scrolled_routes', ['home', 'about']);

    // Mock the Route facade to return 'home' as the current route name
    Route::shouldReceive('currentRouteName')
        ->once()
        ->andReturn('home');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isPreScrolledRoute())->toBeTrue();
});

test('isPreScrolledRoute returns false when current route is not in pre-scrolled routes', function () {
    Config::set('navigation.pre_scrolled_routes', ['home', 'about']);

    // Mock the Route facade to return 'contact' as the current route name (not in the list)
    Route::shouldReceive('currentRouteName')
        ->once()
        ->andReturn('contact');

    $navigation = new Navigation(config('navigation', []));
    expect($navigation->isPreScrolledRoute())->toBeFalse();
});

test('getPreScrolledRoute returns "true" or "false" as string based on isPreScrolledRoute', function () {
    // Test when route is in pre-scrolled routes
    Config::set('navigation.pre_scrolled_routes', ['home', 'about']);
    Route::shouldReceive('currentRouteName')->once()->andReturn('home');
    
    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getPreScrolledRoute())->toBe('true');

    // Test when route is not in pre-scrolled routes  
    Route::shouldReceive('currentRouteName')->once()->andReturn('contact');
    
    $navigation = new Navigation(config('navigation', []));
    expect($navigation->getPreScrolledRoute())->toBe('false');
});
