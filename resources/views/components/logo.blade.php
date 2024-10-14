<div {{ $attributes->only(['class']) }}>
    <a href="{{ config('app.url') }}">
        <span class="sr-only">
            {{ config('app.name') }}
        </span>
        @if(Navigation::isLogoSwapEnabled() && Navigation::isTransparentNavBackground())
            <img x-show="!scrolled"
                 {{ glide()->src(Navigation::getTransparencyLogo(), 1000, lazy: false) }} loading="eager"
                 class="{{ $attributes->get('logoClass', 'w-36 md:w-64 h-auto my-auto') }}"
                 alt="{{ $attributes->get('alt', config('app.name')) }}"/>
            <img x-show="scrolled" {{ glide()->src(Navigation::getDefaultLogo(), 1000, lazy: false) }} loading="eager"
                 class="{{ $attributes->get('logoClass', 'w-36 md:w-64 h-auto my-auto') }}"
                 alt="{{ $attributes->get('alt', config('app.name')) }}"/>
        @else
            <img {{ glide()->src(Navigation::getDefaultLogo(), 1000, lazy: false) }} loading="eager"
                 class="{{ $attributes->get('logoClass', 'w-36 md:w-64 h-auto my-auto') }}"
                 alt="{{ $attributes->get('alt', config('app.name')) }}"/>
        @endif
    </a>
</div>
