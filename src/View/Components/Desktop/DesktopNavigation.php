<?php

namespace Fuelviews\Navigation\View\Components\Desktop;

use Illuminate\View\Component;

class DesktopNavigation extends Component
{
    public $trigger;

    public function __construct($trigger = null)
    {
        $this->trigger = $trigger;
    }

    public function render()
    {
        return view('navigation::components.desktop.desktop-navigation', [
            'trigger' => $this->trigger,
        ]);
    }
}
