<div>
    <a href="tel:{{ config('navigation.phone') }}">
        @if (/*request()->query('gclid') || */request()->cookie('gclid') || session('gclid'))
            <button class="font-brand flex rounded-md bg-prime px-2 py-2 text-md md:text-lg font-bold text-white hover:bg-cta hover:text-black break-keep text-nowrap" onclick="dataLayer.push({'event': 'Phone_Call_Gclid', 'phone_number': '{{ config('navigation.phone') }}'});">
        @else
            <button class="font-brand flex rounded-md bg-prime px-2 py-2 text-md md:text-lg font-bold text-white hover:bg-cta hover:text-black break-keep text-nowrap" onclick="dataLayer.push({'event': 'Phone_Call', 'phone_number': '{{ config('navigation.phone') }}'});">
        @endif
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="my-auto mr-2" height="1em" viewBox="0 0 512 512">
                <path
                    d="M304.3 387.5l-31.9-18.4c-53.8-31-98.6-75.8-129.6-129.6l-18.4-31.9 26-26 33.2-33.2L146 54.2 48.1 72c4.2 214.5 177.4 387.6 391.9 391.9L457.7 366l-94.2-37.7-33.2 33.2-26 26zM352 272l160 64L480 512H448C200.6 512 0 311.4 0 64L0 32 176 0l64 160-55.6 55.6c26.8 46.5 65.5 85.2 112 112L352 272z" />
            </svg>
            {{ config('navigation.phone') }}
        </button>
    </a>
</div>
