<?php

use Fuelviews\Navigation\View\Components\Desktop\DesktopDropdownButton;
use Illuminate\Support\Collection;
use Illuminate\View\View;

test('it renders the correct view', function () {
    $component = new DesktopDropdownButton('Dropdown', []);

    $view = $component->render();

    expect($view)->toBeInstanceOf(View::class);
    expect($view->getName())->toBe('navigation::components.desktop.desktop-dropdown-button');
});

test('it sets the name property', function () {
    $name = 'Dropdown Menu';
    $component = new DesktopDropdownButton($name, []);

    expect($component->name)->toBe($name);
});

test('it converts links to a collection', function () {
    $links = [
        ['name' => 'Link 1', 'route' => 'route1'],
        ['name' => 'Link 2', 'route' => 'route2'],
    ];

    $component = new DesktopDropdownButton('Dropdown', $links);

    expect($component->links)->toBeInstanceOf(Collection::class);
    expect($component->links)->toHaveCount(2);
    expect($component->links[0]['name'])->toBe('Link 1');
    expect($component->links[1]['name'])->toBe('Link 2');
});

test('it handles empty links array', function () {
    $component = new DesktopDropdownButton('Dropdown', []);

    expect($component->links)->toBeInstanceOf(Collection::class);
    expect($component->links)->toBeEmpty();
});

test('it handles links already as a collection', function () {
    $links = collect([
        ['name' => 'Link 1', 'route' => 'route1'],
        ['name' => 'Link 2', 'route' => 'route2'],
    ]);

    $component = new DesktopDropdownButton('Dropdown', $links);

    expect($component->links)->toBeInstanceOf(Collection::class);
    expect($component->links)->toHaveCount(2);
    expect($component->links[0]['name'])->toBe('Link 1');
    expect($component->links[1]['name'])->toBe('Link 2');
});

test('it handles links with different structures', function () {
    $links = [
        ['name' => 'Link 1', 'route' => 'route1'],
        ['name' => 'Link 2', 'url' => 'https://example.com'],
        ['title' => 'Link 3', 'path' => '/path'],
    ];

    $component = new DesktopDropdownButton('Dropdown', $links);

    expect($component->links)->toHaveCount(3);
    expect($component->links[0]['name'])->toBe('Link 1');
    expect($component->links[1]['url'])->toBe('https://example.com');
    expect($component->links[2]['title'])->toBe('Link 3');
});
