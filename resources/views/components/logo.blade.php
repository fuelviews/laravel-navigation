@php
    $logoShape = Navigation::getLogoShape();
    $logoClasses = '';
    if ($logoShape === 'horizontal') {
        $logoClasses = 'mx-auto w-24 lg:w-40';
    } elseif ($logoShape === 'vertical') {
        $logoClasses = 'mx-auto w-24 lg:w-32';
    } elseif ($logoShape === 'square') {
        $logoClasses = 'mx-auto w-24 lg:w-32';
    }
@endphp

<div {{ $attributes->only(['class']) }}>
    <a href="{{ config('app.url') }}">
        <span class="sr-only">
            {{ config('app.name') }}
        </span>
        @if(Navigation::getDefaultLogo() && Navigation::isLogoSwapEnabled() && Navigation::isTransparentNavBackground())
            <img x-show="!scrolled"
                 {{ glide()->src(Navigation::getTransparencyLogo(), 1000, lazy: false) }} loading="eager"
                 class="{{ $attributes->get('logoClass', $logoClasses) }}"
                 alt="{{ $attributes->get('alt', config('app.name')) }}"/>

            <img x-show="scrolled" {{ glide()->src(Navigation::getDefaultLogo(), 1000, lazy: false) }} loading="eager"
                 class="{{ $attributes->get('logoClass', $logoClasses) }}"
                 alt="{{ $attributes->get('alt', config('app.name')) }}"/>
        @else
            <div x-show="!scrolled" class="{{ $attributes->get('logoClass', $logoClasses) }}">
                <x-navigation::social.rocketman />
            </div>
            <div x-show="scrolled" class="{{ $attributes->get('logoClass', $logoClasses) }}">
                <x-navigation::social.rocketman />
            </div>
        @endif
    </a>
</div>
