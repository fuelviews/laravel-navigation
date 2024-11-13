@props(['navigationItems'])

<nav>
    @foreach(Navigation::getNavigationItems() as $index => $item)
        @if($item['type'] === 'link')
            <x-navigation::mobile.mobile-navigation-link :href="route($item['route'])"
                                                         :active="request()->routeIs($item['route'])"
                                                         :bgClass="$bgClass($index)">
                {{ __($item['name']) }}
            </x-navigation::mobile.mobile-navigation-link>
        @elseif($item['type'] === 'dropdown' && array_key_exists('links', $item))
            <x-navigation::mobile.mobile-dropdown
                :name="$item['name']"
                :links="$item['links']"
                :active="Navigation::isDropdownRouteActive($item['links'])"
                :bgClass="$bgClass($index)"
            />
        @endif
    @endforeach
</nav>
