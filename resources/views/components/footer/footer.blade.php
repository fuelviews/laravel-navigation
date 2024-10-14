<div>
    @php
        /* social media accounts */
        if (config('businessinfo.social_media') !== null) {
            $socialMedia = config('businessinfo.social_media');
        }

        $logoShape = Navigation::getLogoShape();
        $logoClasses = '';
        if ($logoShape === 'horizontal') {
            $logoClasses = 'mx-auto w-64 lg:w-72';
        } elseif ($logoShape === 'vertical') {
            $logoClasses = 'mx-auto w-32 lg:w-48';
        } elseif ($logoShape === 'square') {
            $logoClasses = 'mx-auto w-48 lg:w-64';
        }
    @endphp

    <footer class="bg-footer-back">
        <!-- this is important -->
        <div class="mx-auto max-w-waistline px-4 pb-6 pt-16 sm:px-6 lg:px-3 lg:pt-24">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <div>
                    <div class="flex justify-start text-footer-type">
                        @if (Navigation::isLogoSwapEnabled() && Navigation::isTransparentNavBackground())
                            <img
                                    {{ glide()->src(Navigation::getTransparencyLogo()) }}
                                    class="{{ $logoClasses }}"
                                    alt="{{ config('app.name') }}"
                            />
                        @else
                            <img
                                    {{ glide()->src(Navigation::getDefaultLogo()) }}
                                    class="{{ $logoClasses }}"
                                    alt="{{ config('app.name') }}"
                            />
                        @endif
                    </div>

                    <div class="mx-auto flex justify-center gap-x-9 pt-16 lg:pt-8">
                        @isset($socialMedia)
                            <x-navigation::social.youtube :socialMedia="$socialMedia['youtube']" />
                            <x-navigation::social.facebook :socialMedia="$socialMedia['facebook']" />
                            <x-navigation::social.instagram :socialMedia="$socialMedia['instagram']" />
                            <x-navigation::social.xitter :socialMedia="$socialMedia['xitter']" />
                            <x-navigation::social.linkedin :socialMedia="$socialMedia['linkedin']" />
                            <x-navigation::social.tiktok :socialMedia="$socialMedia['tiktok']" />
                        @endisset
                    </div>
                </div>

                <div>
                    <p class="mx-auto mt-4 max-w-md text-center leading-relaxed text-footer-type">
                        @if (config('businessinfo.elevator-pitch') !== null)
                            {{ config('businessinfo.elevator-pitch') }}
                        @endif
                    </p>

                    <div class="flex">
                        <div
                                class="mx-auto flex flex-col justify-center gap-6 pt-6 md:flex-row lg:flex-col xl:flex-row"
                        >
                            <x-navigation::free-estimate-button />
                            <x-navigation::phone-button />
                        </div>
                    </div>
                </div>
            </div>

            <div
                    class="flex flex-col justify-center md:flex-row md:justify-between md:flex-wrap py-6 md:py-12 text-footer-type gap-8">
                <!-- Column 1: Menu (Non-Dropdown Links) -->
                <div class="flex flex-col items-center md:items-start">
                    <p class="font-bold text-xl mt-8 mb-4 md:my-4 pb-2 border-b border-gray-400/75">{{ __('Menu') }}</p>
                    @foreach (Navigation::getNavigationItems() as $item)
                        @if ($item['type'] === 'link')
                            <!-- Non-Dropdown Links -->
                            <x-navigation::footer.footer-navigation-link :href="route($item['route'])"
                                                                         :active="request()->routeIs($item['route'])">
                                {{ __($item['name']) }}
                            </x-navigation::footer.footer-navigation-link>
                        @endif
                    @endforeach
                </div>

                @foreach (Navigation::getNavigationItems() as $item)
                    <!-- Render Dropdowns (e.g., Locations, Services) -->
                    @if ($item['type'] === 'dropdown')
                        <div class="flex flex-col items-center md:items-start">
                            <p class="font-bold text-xl mt-8 mb-4 md:my-4 pb-2 border-b border-gray-400/75">{{ __($item['name']) }}</p>
                            @foreach ($item['links'] as $link)
                                <x-navigation::footer.footer-navigation-link :href="route($link['route'])"
                                                                             :active="request()->routeIs($link['route'])">
                                    {{ __($link['name']) }}
                                </x-navigation::footer.footer-navigation-link>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-6 border-t border-legal-type pt-6">
                <div class="text-center sm:flex sm:justify-between sm:text-left text-gray-400/75">
                    <p class="text-sm text-legal-type">
                        <span class="block sm:inline text-gray-400/75">
                            All rights reserved
                            <span>&middot;</span>
                        </span>

                        @if(Route::is('terms-and-conditions'))
                            <a class="inline-block text-legal-link underline transition hover:text-legal-link/75"
                               href="{{ route('terms-and-conditions') }}"
                               title="Terms & Conditions"
                            >
                                Terms & Conditions
                            </a>

                            <span>&middot;</span>
                        @endif

                        @if(Route::is('privacy-policy'))
                            <a class="inline-block text-legal-link underline transition hover:text-legal-link/75"
                               href="{{ route('privacy-policy') }}"
                               title="Privacy Policy"
                            >
                                Privacy Policy
                            </a>

                            <span>&middot;</span>
                        @endif


                        @if(Route::is('sitemap'))
                            <a class="inline-block text-legal-link underline transition hover:text-legal-link/75"
                               href="{{ route('sitemap') }}"
                               title="Sitemap"
                            >
                                Sitemap
                            </a>
                        @endif
                    </p>

                    <p class="mt-4 text-sm sm:order-first sm:mt-0">
                        &copy; {{ date('Y') }}
                        @if (config('businessinfo.legal-name') !== null)
                            {{ config('businessinfo.legal-name') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
