@php
    switch ($align) {
        case 'left':
            $alignClasses = 'justify-start';
            break;
        case 'center':
            $alignClasses= 'justify-center';
            break;
        case 'right':
        default:
            $alignClasses = 'justify-end';
            break;
    }
@endphp

@if(config('navigation.top_nav_enabled'))
    <div :class="{
             'bg-gray-100 border-b border-gray-200 text-gray-700': scrolled,
             '{{ Navigation::isTransparentNavBackground() ? 'bg-transparent text-white' : 'bg-gray-100 border-b border-gray-200 text-gray-700' }}': !scrolled
         }"
         x-transition>
        <div class="max-w-7xl flex w-full mx-auto px-2 lg:px-4 py-1 {{ $alignClasses }}">
            Top navbar
        </div>
    </div>
@endif
