<button class="flex items-center text-sm leading-5 font-medium hover:text-gray-400 focus:outline-none transition ease-in-out duration-150 uppercase">
    <div class="{{ Navigation::isDropdownRouteActive($links) ? 'border-prime-400' : 'border-transparent' }} border-b-2 hover:border-gray-300 hover:border-b-2 py-2">
        {{ $name }}
    </div>
    <x-navigation::dropdown-icon />
</button>
