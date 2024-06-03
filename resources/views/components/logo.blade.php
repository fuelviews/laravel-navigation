<div {{ $attributes->only(['class']) }}
    x-data="{ scrolled: false }"
    x-init="
        scrolled = window.pageYOffset > window.innerHeight * 0.05;
        window.addEventListener('scroll', () => {
            scrolled = window.pageYOffset > window.innerHeight * 0.05;
        });
    ">
    <a href="{{ route('home') }}" wire:navigate>
        <span class="sr-only">
            {{ config('app.name') }}
        </span>
        @if(config('navigation.logo_swap_enabled') && config('navigation.transparent_nav_background'))
            <template x-if="!scrolled">
                <img {{ glide()->src(config('navigation.transparency_logo'), lazy: false) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
            <template x-if="scrolled">
                <img {{ glide()->src(config('navigation.default_logo')) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
        @else
            <template x-if="true">
            <img {{ glide()->src(config('navigation.default_logo'), lazy: false) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
        @endif
    </a>
</div>
