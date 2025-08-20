<?php

namespace Fuelviews\Navigation\Components\Desktop;

use Illuminate\View\Component;
use Illuminate\View\View;

class DesktopNavigation extends Component
{
    public mixed $trigger;

    public function __construct($trigger = null)
    {
        $this->trigger = $trigger;
    }

    public function render(): View
    {
        return view('navigation::components.desktop.desktop-navigation', [
            'trigger' => $this->trigger,
        ]);
    }
}