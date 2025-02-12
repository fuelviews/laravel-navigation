<?php

namespace Fuelviews\Navigation;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Navigation
{
    public function getNavigationItems(): Collection
    {
        return collect(config('navigation.navigation'))
            ->map(function ($item) {
                if ($item['type'] === 'dropdown-blog') {

                    if (! class_exists(\Fuelviews\SabHeroBlog\SabHeroBlog::class)) {
                        return null;
                    }

                    if (config('navigation.navigation.dropdown-blog.enabled') === true) {
                        return null;
                    }

                    if (empty($item['links'])) {
                        $item['links'] = [
                            [
                                'name' => Str::title(config('sabhero-blog.dropdown.name', 'Blog')),
                                'position' => 0,
                                'route' => 'sabhero-blog.post.index',
                            ],
                            [
                                'name' => 'Categories',
                                'position' => 2,
                                'route' => 'sabhero-blog.category.all',
                            ],
                            [
                                'name' => 'Tags',
                                'position' => 3,
                                'route' => 'sabhero-blog.tag.all',
                            ],
                            [
                                'name' => 'Authors',
                                'position' => 4,
                                'route' => 'sabhero-blog.author.all',
                            ],
                        ];
                    }
                }

                return $item;
            })
            ->filter()
            ->sortBy('position')
            ->values();
    }

    public function getDynamicNavigationItems(): Collection
    {

        if (! class_exists(\Fuelviews\SabHeroBlog\SabHeroBlog::class)) {
            return collect();
        }

        if (config('navigation.navigation.dropdown-blog.enabled') === false) {
            return collect();
        }

        $states = \Fuelviews\SabHeroBlog\Models\Metro::states()->with('children')->get();

        $dynamicLinks = collect();

        foreach ($states as $state) {
            $dynamicLinks->push([
                'name' => $state->name,
                'route' => 'sabhero-blog.post.metro.state.index',
                'params' => ['state' => $state->slug.'#'.$state->slug],
                'type' => 'state',
            ]);

            foreach ($state->children as $city) {
                $dynamicLinks->push([
                    'name' => $city->name,
                    'route' => 'sabhero-blog.post.metro.state.city.index',
                    'params' => [
                        'state' => $state->slug,
                        'city' => $city->slug.'#'.$city->slug,
                    ],
                    'type' => 'city',
                ]);
            }
        }

        return $dynamicLinks;
    }

    public function getCombinedNavigationItems(): \Illuminate\Support\Collection
    {
        $staticItems = $this->getNavigationItems();

        $blogDropdownKey = $staticItems->search(
            fn ($item) => $item['type'] === 'dropdown-blog'
        );

        if ($blogDropdownKey !== false) {
            $blogDropdown = $staticItems[$blogDropdownKey];
            $existingLinks = collect($blogDropdown['links']);
            $dynamicLinks = $this->getDynamicNavigationItems();

            $states = $dynamicLinks->filter(fn ($link) => $link['type'] === 'state');
            $cities = $dynamicLinks->filter(fn ($link) => $link['type'] === 'city');

            [$posZero, $others] = $existingLinks->partition(fn ($link) => ($link['position'] ?? null) === 0);

            $othersSorted = $others->sortBy(fn ($link) => $link['position'] ?? 999999);

            $mergedLinks = $posZero
                ->concat($states)
                ->concat($cities)
                ->concat($othersSorted)
                ->values();

            $blogDropdown['links'] = $mergedLinks->map(function ($link) {
                unset($link['type']);

                return $link;
            })->toArray();

            $staticItems[$blogDropdownKey] = $blogDropdown;
        }

        return $staticItems->sortBy('position')->values();
    }

    public function isDropdownRouteActive($links): bool
    {
        return collect($links)->contains(fn ($link) => request()->routeIs($link['route']));

    }

    public function getDefaultLogo()
    {
        return config('navigation.default_logo');
    }

    public function getLogoShape()
    {
        return config('navigation.logo_shape');
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
        return request()->routeIs(config('navigation.pre_scrolled_routes', []));
    }

    public function getPreScrolledRoute(): string
    {
        return $this->isPreScrolledRoute() ? 'true' : 'false';
    }
}
