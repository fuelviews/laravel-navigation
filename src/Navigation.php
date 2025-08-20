<?php

namespace Fuelviews\Navigation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class Navigation
{
    public function __construct(protected array $config)
    {
    }

    public function getNavigationItems(): Collection
    {
        return collect($this->config['navigation'] ?? [])->sortBy('position')->values();
    }

    public function isDropdownRouteActive(array $links): bool
    {
        return collect($links)->contains(fn (array $link) => request()->routeIs($link['route']));
    }

    public function getDefaultLogo(): string
    {
        return $this->config['default_logo'] ?? '';
    }

    public function getDefaultLogoShape(): string
    {
        return $this->config['default_logo_shape'] ?? 'square';
    }

    public function getTransparencyLogoShape(): string
    {
        return $this->config['transparency_logo_shape'] ?? 'horizontal';
    }

    public function getTransparencyLogo(): string
    {
        return $this->config['transparency_logo'] ?? '';
    }

    public function getPhone(): string
    {
        return $this->config['phone'] ?? '';
    }

    public function isTopNavEnabled(): bool
    {
        return $this->config['top_nav_enabled'] ?? false;
    }

    public function isLogoSwapEnabled(): bool
    {
        return $this->config['logo_swap_enabled'] ?? true;
    }

    public function isTransparentNavBackground(): bool
    {
        return $this->config['transparent_nav_background'] ?? true;
    }

    public function isPreScrolledRoute(): bool
    {
        return in_array(Route::currentRouteName(), $this->config['pre_scrolled_routes'] ?? [], true);
    }

    public function getPreScrolledRoute(): string
    {
        return $this->isPreScrolledRoute() ? 'true' : 'false';
    }
}
