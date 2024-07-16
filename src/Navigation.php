<?php

namespace Fuelviews\Navigation;

use Illuminate\Support\Facades\Route;

class Navigation
{
    public function getNavigationItems()
    {
        return collect(config('navigation.navigation'))->sortBy('position')->values();
    }

    public function isDropdownRouteActive($links)
    {
        return collect($links)->contains(fn ($link) => request()->routeIs($link['route']));

    }

    public function getDefaultLogo()
    {
        return config('navigation.default_logo');
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
