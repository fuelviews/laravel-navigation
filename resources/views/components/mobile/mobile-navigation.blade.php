@props(['navigationItems'])

<nav>
    @foreach(Navigation::getCombinedNavigationItems() as $index => $item)
        {{-- If it's a single link --}}
        @if ($item['type'] === 'link')
            <x-navigation::mobile.mobile-navigation-link
                :href="route($item['route'])"
                :active="request()->routeIs($item['route'])"
                :bgClass="$bgClass($index)"
            >
                {{ __($item['name']) }}
            </x-navigation::mobile.mobile-navigation-link>

            {{-- If it's a standard dropdown (with "links") --}}
        @elseif($item['type'] === 'dropdown' && array_key_exists('links', $item))
            <x-navigation::mobile.mobile-dropdown
                :name="$item['name']"
                :links="$item['links']"
                :active="Navigation::isDropdownRouteActive($item['links'])"
                :bgClass="$bgClass($index)"
            />

            {{-- If it's a blog dropdown AND "enabled" is true --}}
        @elseif($item['type'] === 'dropdown-blog' && ($item['enabled'] ?? false) && array_key_exists('links', $item))
            <x-navigation::mobile.mobile-dropdown
                :name="$item['name']"
                :links="$item['links']"
                :bgClass="$bgClass($index)"
            />
        @endif
    @endforeach
</nav>
