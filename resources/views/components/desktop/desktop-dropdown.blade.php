@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'pt-1 bg-white', 'active'])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
            break;
    }

    switch ($width) {
        case '36':
            $width = 'w-36';
            break;
        case '44':
            $width = 'w-44';
            break;
        case '48':
            $width = 'w-48';
            break;
        case '56':
            $width = 'w-56';
            break;
        case '60':
            $width = 'w-60';
            break;
    }

    $classes = ($active ?? false)
            ? 'block pl-6 pr-4 border-l-4 text-sm border-prime-400 text-base font-medium text-gray-700 bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-100 focus:border-gray-700 transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out rounded-md';
@endphp

<div class="relative uppercase" x-data="{ open: false, manualToggle: false }" @click.outside="open = false; manualToggle = false" @close.stop="open = false; manualToggle = false" @mouseenter="open = true" @mouseleave="open = manualToggle ? open : false">
    <div @click="manualToggle = !manualToggle; open = manualToggle">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 pt-2 w-auto text-nowrap rounded-md shadow-lg {{ $alignmentClasses }}"
         style="display: none;"
         @click="open = false; manualToggle = false"
         @mouseenter="open = true">
        <div class="rounded-md pb-1 ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
