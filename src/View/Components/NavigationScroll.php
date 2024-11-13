<?php

namespace Fuelviews\Navigation\View\Components;

use Illuminate\View\Component;

class NavigationScroll extends Component
{
    public $isTransparent;

    public function __construct($isTransparent = false)
    {
        $this->isTransparent = $isTransparent;
    }

    public function render()
    {
        return view('navigation::components.navigation-scroll');
    }
}
