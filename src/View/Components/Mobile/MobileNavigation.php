<?php

namespace Fuelviews\Navigation\View\Components\Mobile;

use Illuminate\View\Component;

class MobileNavigation extends Component
{
    public $navigationItems;
    public $bgClass;

    public function __construct($bgClass = null)
    {
        $this->navigationItems = collect(config('navigation.navigation'))->sortBy('position')->values();
        $this->bgClass = $bgClass;
    }

    public function bgClass($index): string
    {
        if (is_array($this->bgClass)) {
            return $this->bgClass[$index % count($this->bgClass)];
        }

        return $this->bgClass ?: ($index % 2 === 0 ? 'bg-gray-100' : 'bg-white');
    }

    public function render()
    {
        return view('navigation::components.mobile.mobile-navigation', [
            'navigationItems' => $this->navigationItems,
        ]);
    }
}
