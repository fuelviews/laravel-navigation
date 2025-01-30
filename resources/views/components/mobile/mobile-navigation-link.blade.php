@props(['active', 'name', 'links', 'bgClass', 'route', 'params' => [], 'active' => null])

@php
    $classes = ($active ?? false)
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-prime-400 text-start text-base font-medium text-gray-900 focus:outline-none focus:text-prime-800 focus:bg-prime-100 focus:border-prime-700 transition duration-150 ease-in-out bg-slate-200'
        : "block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-900 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out odd:bg-gray-100";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
