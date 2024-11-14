@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'text-sm font-medium leading-5 hover:text-gray-400 underline underline-2 underline-offset-8 decoration-prime-400 hover:decoration-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out py-2 uppercase'
        : 'text-sm font-medium leading-5 hover:text-gray-400 hover:underline hover:underline-2 hover:underline-offset-8 hover:decoration-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out py-2 uppercase';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
