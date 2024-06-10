<div {{ $attributes->only(['class']) }}
    x-data="{ scrolled: false }"
    x-init="
        scrolled = window.pageYOffset > window.innerHeight * 0.05;
        window.addEventListener('scroll', () => {
            scrolled = window.pageYOffset > window.innerHeight * 0.05;
        });
    ">
    @if (Route::has('home'))
        <a href="{{ route('home') }}">Home</a>
    @else
        <a href="">Home</a>
    @endif
        <span class="sr-only">
            {{ config('app.name') }}
        </span>
        @if(Navigation::isLogoSwapEnabled() && Navigation::isTransparentNavBackground())
            <template x-if="!scrolled">
                <img {{ glide()->src(Navigation::getTransparencyLogo(), lazy: false) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
            <template x-if="scrolled">
                <img {{ glide()->src(Navigation::getDefaultLogo()) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
        @else
            <template x-if="true">
            <img {{ glide()->src(Navigation::getDefaultLogo(), lazy: false) }} loading="eager" class="{{ $attributes->get('logoClass', 'w-24 lg:w-28 h-auto my-auto') }}" alt="{{ $attributes->get('alt', config('app.name')) }}" />
            </template>
        @endif
    </a>
</div>
