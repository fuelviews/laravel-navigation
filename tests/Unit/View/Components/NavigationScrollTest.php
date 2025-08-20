<?php

use Fuelviews\Navigation\Components\NavigationScroll;
use Illuminate\View\View;

test('it renders the correct view', function () {
    $component = new NavigationScroll;

    $view = $component->render();

    expect($view)->toBeInstanceOf(View::class);
    expect($view->getName())->toBe('navigation::components.navigation-scroll');
});

test('it defaults isTransparent to false', function () {
    $component = new NavigationScroll;

    expect($component->isTransparent)->toBeFalse();
});

test('it sets isTransparent to true when provided', function () {
    $component = new NavigationScroll(true);

    expect($component->isTransparent)->toBeTrue();
});

test('it sets isTransparent to the provided value', function () {
    // Test with boolean true
    $component = new NavigationScroll(true);
    expect($component->isTransparent)->toBeTrue();

    // Test with boolean false
    $component = new NavigationScroll(false);
    expect($component->isTransparent)->toBeFalse();

    // Test with string 'true'
    $component = new NavigationScroll('true');
    expect($component->isTransparent)->toBe('true');

    // Test with string 'false'
    $component = new NavigationScroll('false');
    expect($component->isTransparent)->toBe('false');

    // Test with integer 1
    $component = new NavigationScroll(1);
    expect($component->isTransparent)->toBe(1);

    // Test with integer 0
    $component = new NavigationScroll(0);
    expect($component->isTransparent)->toBe(0);
});
