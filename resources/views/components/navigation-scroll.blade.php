<nav x-data="{ open: false, scrolled: false, showEstimate: false, isMobile: window.innerWidth < 640, transparentNav: {{ config('navigation.transparent_nav_background') ? 'true' : 'false' }} }"
     x-init="
        if (transparentNav) {
            scrolled = (window.scrollY > window.innerHeight * 0.05);
            showEstimate = (window.scrollY > window.innerHeight * 0.25);
            window.addEventListener('scroll', () => {
                scrolled = (window.scrollY > window.innerHeight * 0.05);
                showEstimate = (window.scrollY > window.innerHeight * 0.25);
            });
        }
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth < 640;
            if (!isMobile) showEstimate = false;
        });
     "
     :class="{
         'bg-white text-gray-700': scrolled && transparentNav,
         '{{ config('navigation.transparent_nav_background') ? 'bg-transparent text-white' : 'bg-white text-gray-700' }}': !scrolled || !transparentNav
     }"
     class="bg-white duration-600 fixed inset-x-0 top-0 z-40 drop-shadow-2xl transition-all"
     x-cloak
     x-transition>

    {{ $slot }}
</nav>
