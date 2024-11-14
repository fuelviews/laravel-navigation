<?php

namespace Fuelviews\Navigation\View\Components\Desktop;

use Illuminate\View\Component;

class DesktopDropdownButton extends Component
{
    public $name;

    public $links;

    public function __construct($name, $links)
    {
        $this->name = $name;
        $this->links = collect($links);
    }

    public function render()
    {
        return view('navigation::components.desktop.desktop-dropdown-button');
    }
}
