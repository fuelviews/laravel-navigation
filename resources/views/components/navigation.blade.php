<!-- Navigation Scroll/Transparency -->
<x-navigation::navigation-scroll :isTransparent="Navigation::isTransparentNavBackground()">

    <!-- Top Nav Bar (Shows on Mobile) -->
    <x-navigation::top-bar align="center" />

    <!-- Responsive/Desktop Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2 lg:px-4 py-2 lg:py-4">
        <div class="flex justify-between items-center">

            <!-- Logo (Shows on Mobile) -->
            <div class="shrink-0 flex items-center">
                <x-navigation::logo />
            </div>

            <!-- Desktop Navigation -->
            <div class="md:flex md:flex-col md:items-end md:justify-between">
                <div class="hidden md:flex md:flex-row md:space-x-4 md:order-2">
                    <x-navigation::desktop.desktop-navigation />
                </div>

                <!-- Responsive/Desktop CTA Buttons -->
                <div class="flex items-center space-x-4 justify-end md:order-1 md:pb-2">
                    <template x-if="!isMobile || !showEstimate">
                        <x-navigation::phone-button />
                    </template>
                    <template x-if="!isMobile || showEstimate">
                        <x-navigation::free-estimate-button />
                    </template>
                </div>
            </div>

            <!-- Hamburger (Shows on Mobile) -->
            <div class="flex items-center md:hidden space-x-4">
                <button @click="open = !open">
                    <x-navigation::hamburger-button />
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-white overflow-y-auto max-h-screen -mx-2 mt-2">


            <div class="border-t border-gray-300">
                <x-navigation::mobile.mobile-navigation />

                <!-- Mobile CTA Buttons -->
                <div class="ml-2 py-4 space-y-4">
                    <x-navigation::phone-button />
                    <x-navigation::free-estimate-button />
                </div>
            </div>
        </div>
    </div>
</x-navigation::navigation-scroll>
