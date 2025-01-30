@props(['active', 'name', 'links', 'bgClass', 'route', 'params' => [], 'active' => null])

@php
    $classes = ($active)
        ? "block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-900 hover:text-gray-700 hover:border-prime-400 focus:outline-none focus:text-gray-800 focus:bg-gray-50 hover:bg-slate-200 focus:border-prime-300 transition duration-150 ease-in-out border-l-4 bg-slate-200 border-prime-400"
        : "block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-gray-900 hover:text-gray-700 hover:border-prime-400 focus:outline-none focus:text-gray-800 focus:bg-gray-50 hover:bg-slate-200 focus:border-gray-400 transition duration-150 ease-in-out border-l-4 $bgClass";
@endphp

<div x-data="{ dropdownOpen: false }" class="relative w-full">
    <a @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false; manualToggle = false"
       class="w-full text-left flex items-center justify-start cursor-pointer">
        <button {{ $attributes->merge(['class' => $classes]) }}>
            {{ $name }}
            <x-navigation::dropdown-icon/>
        </button>
    </a>

    <div x-show="dropdownOpen" x-transition class="w-full lg:mt-2">
        @foreach($links as $link)
            @php
                // If 'params' exist, pass them to route()
                $url = isset($link['params'])
                    ? route($link['route'], $link['params'])
                    : route($link['route']);
            @endphp

            <x-navigation::dropdown-link
                :href="$url"
                :active="request()->routeIs($link['route'])"
            >
                {{ $link['name'] }}
            </x-navigation::dropdown-link>
        @endforeach

    </div>
</div>
