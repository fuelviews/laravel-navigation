<?php

use Fuelviews\Navigation\Components\Mobile\MobileNavigation;
use Illuminate\View\View;

test('it renders the correct view', function () {
    $component = new MobileNavigation();

    $view = $component->render();

    expect($view)->toBeInstanceOf(View::class);
    expect($view->getName())->toBe('navigation::components.mobile.mobile-navigation');
});

test('it passes bgClass to the view', function () {
    $bgClass = 'custom-bg-class';
    $component = new MobileNavigation($bgClass);

    $view = $component->render();

    expect($view->getData()['bgClass'])->toBe($bgClass);
});

test('it returns default background classes for even and odd indices when no bgClass is provided', function () {
    $component = new MobileNavigation();

    expect($component->getBackgroundClass(0))->toBe('bg-gray-100');
    expect($component->getBackgroundClass(1))->toBe('bg-white');
    expect($component->getBackgroundClass(2))->toBe('bg-gray-100');
    expect($component->getBackgroundClass(3))->toBe('bg-white');
});

test('it returns custom background class when string is provided', function () {
    $bgClass = 'custom-bg-class';
    $component = new MobileNavigation($bgClass);

    expect($component->getBackgroundClass(0))->toBe($bgClass);
    expect($component->getBackgroundClass(1))->toBe($bgClass);
});

test('it cycles through background classes when array is provided', function () {
    $bgClasses = ['bg-red-100', 'bg-blue-100', 'bg-green-100'];
    $component = new MobileNavigation($bgClasses);

    expect($component->getBackgroundClass(0))->toBe('bg-red-100');
    expect($component->getBackgroundClass(1))->toBe('bg-blue-100');
    expect($component->getBackgroundClass(2))->toBe('bg-green-100');
    expect($component->getBackgroundClass(3))->toBe('bg-red-100'); // Cycles back to the first
});
