@php
    $defaultLogoShape = Navigation::getDefaultLogoShape();
    $transparencyLogoShape = Navigation::getTransparencyLogoShape();

    // Classes for default logo
    $defaultLogoClasses = '';
    if ($defaultLogoShape === 'horizontal') {
        $defaultLogoClasses = 'mx-auto w-24 lg:w-40';
    } elseif ($defaultLogoShape === 'vertical') {
        $defaultLogoClasses = 'mx-auto w-24 lg:w-32';
    } elseif ($defaultLogoShape === 'square') {
        $defaultLogoClasses = 'mx-auto w-24 lg:w-32';
    }

    // Classes for transparency logo
    $transparencyLogoClasses = '';
    if ($transparencyLogoShape === 'horizontal') {
        $transparencyLogoClasses = 'mx-auto w-24 lg:w-40';
    } elseif ($transparencyLogoShape === 'vertical') {
        $transparencyLogoClasses = 'mx-auto w-24 lg:w-32';
    } elseif ($transparencyLogoShape === 'square') {
        $transparencyLogoClasses = 'mx-auto w-24 lg:w-32';
    }
@endphp

<div {{ $attributes->only(['class']) }}>
    <a href="{{ config('app.url') }}">
        <span class="sr-only">
            {{ config('app.name') }}
        </span>
        @if(Navigation::getDefaultLogo())
            @if(Navigation::isLogoSwapEnabled())
                <img x-show="!logoScrolled"
                     {{ glide()->src(Navigation::getTransparencyLogo(), 1000, lazy: false) }} loading="eager"
                     class="{{ $attributes->get('logoClass', $transparencyLogoClasses) }}"
                     alt="{{ $attributes->get('alt', config('app.name')) }}"/>

                <img x-show="logoScrolled" {{ glide()->src(Navigation::getDefaultLogo(), 1000, lazy: false) }} loading="eager"
                     class="{{ $attributes->get('logoClass', $defaultLogoClasses) }}"
                     alt="{{ $attributes->get('alt', config('app.name')) }}"/>
            @else
                <img {{ glide()->src(Navigation::getDefaultLogo(), 1000, lazy: false) }} loading="eager"
                     class="{{ $attributes->get('logoClass', $defaultLogoClasses) }}"
                     alt="{{ $attributes->get('alt', config('app.name')) }}"/>
            @endif
        @else
            <div class="{{ $attributes->get('logoClass', $defaultLogoClasses) }}">
                <x-navigation::social.rocketman />
            </div>
        @endif
    </a>
</div>
