<?php

namespace Fuelviews\Navigation;

use Illuminate\Support\Collection;

class Navigation
{
    public function getNavigationItems(): Collection
    {
        $items = collect(config('navigation.navigation'))
            ->map(function ($item) {
                // If it's our blog dropdown AND has no 'links', provide defaults
                if ($item['type'] === 'dropdown-blog') {
                    // Optionally set a default 'enabled' if not present
                    if (! array_key_exists('enabled', $item)) {
                        $item['enabled'] = true;
                    }

                    // If links are not defined or are empty, supply a default set
                    if (empty($item['links'])) {
                        $item['links'] = [
                            [
                                'name' => 'Blog',
                                'position' => 0,
                                'route' => 'sabblog.post.index',
                            ],
                            [
                                'name' => 'Categories',
                                'position' => 2,
                                'route' => 'sabblog.category.all',
                            ],
                            [
                                'name' => 'Tags',
                                'position' => 3,
                                'route' => 'sabblog.tag.all',
                            ],
                            [
                                'name' => 'Authors',
                                'position' => 4,
                                'route' => 'sabblog.author.all',
                            ],
                        ];
                    }
                }

                return $item;
            })
            ->sortBy('position')
            ->values();

        return $items;
    }

    public function getDynamicNavigationItems(): Collection
    {

        if (! class_exists(\App\Models\Metro::class)) {
            return collect();
        }

        $states = \App\Models\Metro::states()->with('children')->get();

        $dynamicLinks = collect();

        foreach ($states as $state) {
            $dynamicLinks->push([
                'name' => $state->name,
                'route' => 'sabblog.post.metro.state.index',
                'params' => ['state' => $state->slug.'#'.$state->slug],
                'type' => 'state',
            ]);

            foreach ($state->children as $city) {
                $dynamicLinks->push([
                    'name' => $city->name,
                    'route' => 'sabblog.post.metro.city.index',
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

        // 1) Locate the 'blog-dropdown'
        $blogDropdownKey = $staticItems->search(
            fn ($item) => $item['type'] === 'dropdown-blog'
        );

        if ($blogDropdownKey !== false) {
            // 2) Grab the existing blog-dropdown and dynamic links
            $blogDropdown = $staticItems[$blogDropdownKey];
            $existingLinks = collect($blogDropdown['links']); // existing sub-links
            $dynamicLinks = $this->getDynamicNavigationItems();

            // Separate states & cities
            $states = $dynamicLinks->filter(fn ($link) => $link['type'] === 'state');
            $cities = $dynamicLinks->filter(fn ($link) => $link['type'] === 'city');

            // 3) Partition the existing links by position=0
            //    "position=0" is presumably your "Blog" link
            [$posZero, $others] = $existingLinks->partition(fn ($link) => ($link['position'] ?? null) === 0);

            // 4) Sort $others by ascending position (e.g. 1,2,3,...).
            //    If some items don't have a position, they go last.
            $othersSorted = $others->sortBy(fn ($link) => $link['position'] ?? 999999);

            // 5) Rebuild the links:
            //    - All position=0 items
            //    - Then all states
            //    - Then all cities
            //    - Then everything else
            $mergedLinks = $posZero
                ->concat($states)
                ->concat($cities)
                ->concat($othersSorted)
                ->values();

            // 6) Update the 'blog-dropdown' with the new links array
            $blogDropdown['links'] = $mergedLinks->map(function ($link) {
                // Remove 'type' if you like or keep it
                unset($link['type']);

                return $link;
            })->toArray();

            // Put it back into the static items
            $staticItems[$blogDropdownKey] = $blogDropdown;
        }

        // Finally, sort top-level items by their 'position' if needed
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
