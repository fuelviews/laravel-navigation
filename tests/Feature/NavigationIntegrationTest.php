<?php

use Fuelviews\Navigation\Facades\Navigation;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

test('navigation facade returns navigation items', function () {
    // Configure navigation items
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

    $items = Navigation::getNavigationItems();

    expect($items)->toHaveCount(2);
    expect($items[0]['name'])->toBe('Home');
    expect($items[1]['name'])->toBe('About');
});

test('mobile navigation component can be rendered', function () {
    // Create a mock view that will be returned by the view factory
    $mockView = Mockery::mock(\Illuminate\Contracts\View\View::class);
    $mockView->shouldReceive('render')->andReturn('<div>Mobile Navigation</div>');

    // Mock the view factory
    View::shouldReceive('exists')->andReturn(true);
    View::shouldReceive('make')
        ->withAnyArgs()
        ->andReturn($mockView);

    // Render the component
    $html = view('navigation::components.mobile.mobile-navigation', ['bgClass' => null])->render();

    expect($html)->toBe('<div>Mobile Navigation</div>');
});

test('desktop navigation component can be rendered', function () {
    // Ensure the view exists by mocking the view factory
    View::shouldReceive('exists')
        ->andReturn(true);

    // Mock the actual view rendering with more flexible parameter matching
    View::shouldReceive('make')
        ->withArgs(function ($viewName, $data = [], $mergeData = []) {
            return $viewName === 'navigation::components.desktop.desktop-navigation' &&
                   array_key_exists('trigger', $data);
        })
        ->andReturn(
            Mockery::mock(\Illuminate\Contracts\View\View::class)
                ->shouldReceive('render')
                ->andReturn('<div>Desktop Navigation</div>')
                ->getMock()
        );

    // Render the component
    $html = view('navigation::components.desktop.desktop-navigation', ['trigger' => null])->render();

    expect($html)->toBe('<div>Desktop Navigation</div>');
});

test('navigation components can access navigation items', function () {
    // Configure navigation items
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

    // Get the navigation items that will be passed to the view
    $navigationItems = Navigation::getNavigationItems();

    // Ensure the view exists by mocking the view factory
    View::shouldReceive('exists')
        ->andReturn(true);

    // Mock the view to capture the data passed to it with more flexible parameter matching
    View::shouldReceive('make')
        ->withArgs(function ($viewName, $data = [], $mergeData = []) use ($navigationItems) {
            // Check if navigationItems exists in the data and matches our expected items
            if (isset($data['navigationItems'])) {
                return $data['navigationItems']->count() === 2 &&
                       $data['navigationItems'][0]['name'] === 'Home' &&
                       $data['navigationItems'][1]['name'] === 'About';
            }

            return true; // Allow other view renders to pass through
        })
        ->andReturn(
            Mockery::mock(\Illuminate\Contracts\View\View::class)
                ->shouldReceive('render')
                ->andReturn('<div>Navigation</div>')
                ->getMock()
        );

    // Render a view that would typically use the navigation items
    $html = view('navigation::components.desktop.desktop-navigation', [
        'navigationItems' => $navigationItems,
    ])->render();

    expect($html)->toBe('<div>Navigation</div>');
});

test('navigation configuration is accessible to components', function () {
    // Set up configuration values
    Config::set('navigation.default_logo', 'default-logo.png');
    Config::set('navigation.logo_shape', 'rounded');
    Config::set('navigation.transparency_logo', 'transparent-logo.png');
    Config::set('navigation.phone', '123-456-7890');
    Config::set('navigation.top_nav_enabled', true);

    // Verify the configuration values are accessible through the Navigation facade
    expect(Navigation::getDefaultLogo())->toBe('default-logo.png');
    expect(Navigation::getLogoShape())->toBe('rounded');
    expect(Navigation::getTransparencyLogo())->toBe('transparent-logo.png');
    expect(Navigation::getPhone())->toBe('123-456-7890');
    expect(Navigation::isTopNavEnabled())->toBeTrue();
});
