<?php

use Fuelviews\Navigation\Navigation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

beforeEach(function () {
    $this->navigation = new Navigation();
});

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

    $items = $this->navigation->getNavigationItems();

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

    $items = $this->navigation->getNavigationItems();

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

    expect($this->navigation->isDropdownRouteActive($links))->toBeTrue();
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

    expect($this->navigation->isDropdownRouteActive($links))->toBeFalse();
});

test('getDefaultLogo returns the configured default logo', function () {
    Config::set('navigation.default_logo', 'default-logo.png');

    expect($this->navigation->getDefaultLogo())->toBe('default-logo.png');
});

test('getLogoShape returns the configured logo shape', function () {
    Config::set('navigation.logo_shape', 'rounded');

    expect($this->navigation->getLogoShape())->toBe('rounded');
});

test('getTransparencyLogo returns the configured transparency logo', function () {
    Config::set('navigation.transparency_logo', 'transparent-logo.png');

    expect($this->navigation->getTransparencyLogo())->toBe('transparent-logo.png');
});

test('getPhone returns the configured phone number', function () {
    Config::set('navigation.phone', '123-456-7890');

    expect($this->navigation->getPhone())->toBe('123-456-7890');
});

test('isTopNavEnabled returns the configured top nav enabled status', function () {
    Config::set('navigation.top_nav_enabled', true);

    expect($this->navigation->isTopNavEnabled())->toBeTrue();

    Config::set('navigation.top_nav_enabled', false);

    expect($this->navigation->isTopNavEnabled())->toBeFalse();
});

test('isLogoSwapEnabled returns the configured logo swap enabled status', function () {
    Config::set('navigation.logo_swap_enabled', true);

    expect($this->navigation->isLogoSwapEnabled())->toBeTrue();

    Config::set('navigation.logo_swap_enabled', false);

    expect($this->navigation->isLogoSwapEnabled())->toBeFalse();
});

test('isTransparentNavBackground returns the configured transparent nav background status', function () {
    Config::set('navigation.transparent_nav_background', true);

    expect($this->navigation->isTransparentNavBackground())->toBeTrue();

    Config::set('navigation.transparent_nav_background', false);

    expect($this->navigation->isTransparentNavBackground())->toBeFalse();
});

test('isPreScrolledRoute returns true when current route is in pre-scrolled routes', function () {
    Config::set('navigation.pre_scrolled_routes', ['home', 'about']);

    // Mock the Request facade with setUserResolver to avoid BadMethodCallException
    $requestMock = Mockery::mock('Illuminate\Http\Request');
    $requestMock->shouldReceive('routeIs')
        ->with(['home', 'about'])
        ->andReturn(true);
    $requestMock->shouldReceive('setUserResolver')
        ->andReturn($requestMock);

    // Replace the request instance in the container
    app()->instance('request', $requestMock);

    expect($this->navigation->isPreScrolledRoute())->toBeTrue();
});

test('isPreScrolledRoute returns false when current route is not in pre-scrolled routes', function () {
    Config::set('navigation.pre_scrolled_routes', ['home', 'about']);

    // Mock the Request facade with setUserResolver to avoid BadMethodCallException
    $requestMock = Mockery::mock('Illuminate\Http\Request');
    $requestMock->shouldReceive('routeIs')
        ->with(['home', 'about'])
        ->andReturn(false);
    $requestMock->shouldReceive('setUserResolver')
        ->andReturn($requestMock);

    // Replace the request instance in the container
    app()->instance('request', $requestMock);

    expect($this->navigation->isPreScrolledRoute())->toBeFalse();
});

test('getPreScrolledRoute returns "true" or "false" as string based on isPreScrolledRoute', function () {
    // Mock isPreScrolledRoute to return true
    $navigation = $this->createPartialMock(Navigation::class, ['isPreScrolledRoute']);
    $navigation->method('isPreScrolledRoute')->willReturn(true);
    expect($navigation->getPreScrolledRoute())->toBe('true');

    // Mock isPreScrolledRoute to return false
    $navigation = $this->createPartialMock(Navigation::class, ['isPreScrolledRoute']);
    $navigation->method('isPreScrolledRoute')->willReturn(false);
    expect($navigation->getPreScrolledRoute())->toBe('false');
});
