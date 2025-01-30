@foreach(Navigation::getCombinedNavigationItems() as $item)
    @if($item['type'] === 'link')
        <x-navigation::desktop.desktop-navigation-link :href="route($item['route'])"
                                                       :active="request()->routeIs($item['route'])">
            {{ __($item['name']) }}
        </x-navigation::desktop.desktop-navigation-link>
    @elseif($item['type'] === 'dropdown')
        <div x-data="{ open: false }" class="hidden md:flex sm:items-center">
            <x-navigation::desktop.desktop-dropdown align="left">
                <x-slot name="trigger">
                    <x-navigation::desktop.desktop-dropdown-button :name="$item['name']" :links="$item['links']"/>
                </x-slot>

                <x-slot name="content" x-show="open">
                    @foreach($item['links'] as $link)
                        @php
                            // Check if params exist, otherwise fallback to route
                            $url = isset($link['params'])
                                ? route($link['route'], $link['params'])
                                : route($link['route']);
                        @endphp
                        <x-navigation::dropdown-link :href="$url"
                                                     :active="request()->routeIs($link['route'])">
                            {{ __($link['name']) }}
                        </x-navigation::dropdown-link>
                    @endforeach
                </x-slot>
            </x-navigation::desktop.desktop-dropdown>
        </div>
    @elseif($item['type'] === 'dropdown-blog' && ($item['enabled'] ?? false))
        <div x-data="{ open: false }" class="hidden md:flex sm:items-center">
            <x-navigation::desktop.desktop-dropdown align="left">
                <x-slot name="trigger">
                    <x-navigation::desktop.desktop-dropdown-button :name="$item['name']" :links="$item['links'] ?? []" />
                </x-slot>

                <x-slot name="content" x-show="open">
                    @foreach($item['links'] as $link)
                        @php
                            $url = isset($link['params'])
                                ? route($link['route'], $link['params'])
                                : route($link['route']);
                        @endphp
                        <x-navigation::dropdown-link :href="$url"
                                                     :active="request()->routeIs($link['route'])">
                            {{ __($link['name']) }}
                        </x-navigation::dropdown-link>
                    @endforeach
                </x-slot>
            </x-navigation::desktop.desktop-dropdown>
        </div>
    @endif
@endforeach
