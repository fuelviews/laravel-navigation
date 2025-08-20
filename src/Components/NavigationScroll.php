<?php

namespace Fuelviews\Navigation\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class NavigationScroll extends Component
{
    public mixed $isTransparent;

    public function __construct($isTransparent = false)
    {
        $this->isTransparent = $isTransparent;
    }

    public function render(): View
    {
        return view('navigation::components.navigation-scroll');
    }
}