<?php

namespace Fuelviews\Navigation\View\Components\Footer;

use Illuminate\View\Component;
use Illuminate\View\View;

class Footer extends Component
{
    public function render(): View
    {
        return view('navigation::components.footer.footer');
    }
}
