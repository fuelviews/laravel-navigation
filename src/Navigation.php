<?php

namespace Fuelviews\Navigation;

use Illuminate\Support\Facades\Route;

class Navigation
{
    public function getNavigationItems(): \Illuminate\Support\Collection
    {
        return collect(config('navigation.navigation'))->sortBy('position')->values();
    }

    public function isDropdownRouteActive($links): bool
    {
        return collect($links)->contains(fn ($link) => request()->routeIs($link['route']));

    }

    public function getDefaultLogo()
    {
        return config('navigation.default_logo');
    }

    public function getDefaultLogoShape()
    {
        return config('navigation.default_logo_shape', 'square');
    }

    public function getTransparencyLogoShape()
    {
        return config('navigation.transparency_logo_shape', 'horizontal');
    }

    public function getTransparencyLogo()
    {
        return config('navigation.transparency_logo');
    }

    public function getPhone()
    {
        return config('navigation.phone');
    }

    public function isTopNavEnabled()
    {
        return config('navigation.top_nav_enabled');
    }

    public function isLogoSwapEnabled()
    {
        return config('navigation.logo_swap_enabled');
    }

    public function isTransparentNavBackground()
    {
        return config('navigation.transparent_nav_background');
    }

    public function isPreScrolledRoute(): bool
    {
        return in_array(Route::currentRouteName(), config('navigation.pre_scrolled_routes', []), true);
    }

    public function getPreScrolledRoute(): string
    {
        return $this->isPreScrolledRoute() ? 'true' : 'false';
    }
}
