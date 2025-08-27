@props(['active' => false])

@php
    $classes = ($active ?? false)
        ? "block pl-4 px-4 py-2 border-l-4 text-sm border-prime-400 text-base font-medium text-gray-700 bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-100 focus:border-gray-700 ease-in-out first:rounded-tr-lg last:rounded-br-lg"
        : "block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 ease-in-out odd:bg-slate-100 first:rounded-t-lg last:rounded-b-lg";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
