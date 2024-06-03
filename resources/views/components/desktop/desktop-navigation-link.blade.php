@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center border-b-2 border-prime-400 text-sm font-medium leading-5 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out py-2 uppercase'
                : 'inline-flex items-center border-b-2 border-transparent text-sm font-medium leading-5 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out py-2 uppercase';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
