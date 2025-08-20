<?php

namespace Fuelviews\Navigation\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TopBar extends Component
{
    public mixed $align;

    public function __construct($align = null)
    {
        $this->align = $align;
    }

    public function render(): View
    {
        return view('navigation::components.top-bar');
    }
}