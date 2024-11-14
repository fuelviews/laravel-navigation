<nav x-data="{
        open: false,
        dropdownOpen: false,
        scrolled: {{ Navigation::getPreScrolledRoute() }},
        showEstimate: false,
        isMobile: window.innerWidth < 640,
        transparentNav: {{  Navigation::isTransparentNavBackground() ? 'true' : 'false' }}
    }"
     x-init="
        if (transparentNav) {
            scrolled = (window.scrollY > window.innerHeight * 0.05) || {{ Navigation::getPreScrolledRoute() }};
            showEstimate = (window.scrollY > window.innerHeight * 0.25);
            window.addEventListener('scroll', () => {
                if (!{{ Navigation::getPreScrolledRoute() }}) {
                    scrolled = (window.scrollY > window.innerHeight * 0.05);
                }
                showEstimate = (window.scrollY > window.innerHeight * 0.25);
            });
        }
        window.addEventListener('resize', () => {
            isMobile = window.innerWidth < 640;
            if (!isMobile) showEstimate = false;
        });
     "
     :class="{
         'bg-nav text-nav-type': scrolled || {{ Navigation::getPreScrolledRoute() }},
         '{{ Navigation::isTransparentNavBackground() ? 'bg-transparent text-nav-type-trans' : 'bg-nav text-nav-type' }}': !scrolled && !{{ Navigation::getPreScrolledRoute() }}
     }"
     class="duration-600 fixed inset-x-0 top-0 z-40 drop-shadow-2xl transition-all"
     x-cloak
     x-transition>

    {{ $slot }}
</nav>
