@foreach(Navigation::getNavigationItems() as $item)
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
                        <x-navigation::dropdown-link :href="route($link['route'])"
                                                     :active="request()->routeIs($link['route'])">
                            {{ __($link['name']) }}
                        </x-navigation::dropdown-link>
                    @endforeach
                </x-slot>
            </x-navigation::desktop.desktop-dropdown>
        </div>
    @endif
@endforeach
