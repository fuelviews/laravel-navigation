<?php

use Fuelviews\Navigation\Components\Desktop\DesktopNavigation;
use Illuminate\View\View;

test('it renders the correct view', function () {
    $component = new DesktopNavigation;

    $view = $component->render();

    expect($view)->toBeInstanceOf(View::class);
    expect($view->getName())->toBe('navigation::components.desktop.desktop-navigation');
});

test('it passes trigger to the view', function () {
    $trigger = 'custom-trigger';
    $component = new DesktopNavigation($trigger);

    $view = $component->render();

    expect($view->getData()['trigger'])->toBe($trigger);
});

test('it handles null trigger', function () {
    $component = new DesktopNavigation;

    $view = $component->render();

    expect($view->getData()['trigger'])->toBeNull();
});

test('it handles different trigger types', function () {
    // Test with a string
    $component = new DesktopNavigation('string-trigger');
    expect($component->render()->getData()['trigger'])->toBe('string-trigger');

    // Test with an array
    $arrayTrigger = ['key' => 'value'];
    $component = new DesktopNavigation($arrayTrigger);
    expect($component->render()->getData()['trigger'])->toBe($arrayTrigger);

    // Test with an object
    $objectTrigger = new stdClass;
    $objectTrigger->property = 'value';
    $component = new DesktopNavigation($objectTrigger);
    expect($component->render()->getData()['trigger'])->toBe($objectTrigger);

    // Test with a boolean
    $component = new DesktopNavigation(true);
    expect($component->render()->getData()['trigger'])->toBeTrue();
});
