<nav>
    @foreach(Navigation::getNavigationItems() as $index => $item)
        @php
            $bgClass = $index % 2 === 0 ? 'bg-gray-100' : 'bg-white';
        @endphp

        @if ($item['type'] === 'link')
            @php
                $linkUrl = isset($item['params'])
                    ? route($item['route'], $item['params'])
                    : route($item['route']);

                $parsedPath = trim(parse_url($linkUrl, PHP_URL_PATH) ?? '', '/');

                $active = request()->is($parsedPath) || request()->is($parsedPath . '/*');
            @endphp

            <x-navigation::mobile.mobile-navigation-link
                :href="$linkUrl"
                :active="$active"
            >
                {{ __($item['name']) }}
            </x-navigation::mobile.mobile-navigation-link>

        @elseif ($item['type'] === 'dropdown' && array_key_exists('links', $item))
            @php
                $dropdownActive = false;

                foreach ($item['links'] as $link) {
                    $linkUrl = isset($link['params'])
                        ? route($link['route'], $link['params'])
                        : route($link['route']);

                    $parsedPath = trim(parse_url($linkUrl, PHP_URL_PATH) ?? '', '/');

                    if (request()->is($parsedPath) || request()->is($parsedPath . '/*')) {
                        $dropdownActive = true;
                        break;
                    }
                }
            @endphp

            <x-navigation::mobile.mobile-dropdown
                :name="$item['name']"
                :links="$item['links']"
                :active="$dropdownActive"
                :bgClass="$bgClass"
            />
        @endif
    @endforeach
</nav>
