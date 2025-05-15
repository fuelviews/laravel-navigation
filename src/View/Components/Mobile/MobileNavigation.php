<?php

namespace Fuelviews\Navigation\View\Components\Mobile;

use Illuminate\View\Component;
use Illuminate\View\View;

class MobileNavigation extends Component
{
    private const string DEFAULT_BG_EVEN = 'bg-gray-100';
    private const string DEFAULT_BG_ODD = 'bg-white';

    public mixed $bgClass;

    public function __construct(mixed $bgClass = null)
    {
        $this->bgClass = $bgClass;
    }

    public function getBackgroundClass(int $index): string
    {
        if (is_array($this->bgClass)) {
            return $this->bgClass[$index % count($this->bgClass)];
        }

        return $this->bgClass ?? $this->getDefaultBackgroundClass($index);
    }

    private function getDefaultBackgroundClass(int $index): string
    {
        return $index % 2 === 0 ? self::DEFAULT_BG_EVEN : self::DEFAULT_BG_ODD;
    }

    public function render(): View
    {
        return view('navigation::components.mobile.mobile-navigation', [
            'bgClass' => $this->bgClass,
        ]);
    }
}
