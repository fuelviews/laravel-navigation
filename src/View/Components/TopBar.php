<?php

namespace Fuelviews\Navigation\View\Components;

use Illuminate\View\Component;

class TopBar extends Component
{
    public $align;

    public function __construct($align = null)
    {
        $this->align = $align;
    }

    public function render()
    {
        return view('navigation::components.top-bar');
    }
}
