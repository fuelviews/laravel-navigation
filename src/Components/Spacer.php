<?php

namespace Fuelviews\Navigation\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Spacer extends Component
{
    public function render(): View
    {
        return view('navigation::components.spacer');
    }
}