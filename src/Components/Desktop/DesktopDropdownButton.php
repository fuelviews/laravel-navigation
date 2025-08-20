<?php

namespace Fuelviews\Navigation\Components\Desktop;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class DesktopDropdownButton extends Component
{
    public string $name;

    public Collection $links;

    public function __construct($name, $links)
    {
        $this->name = $name;
        $this->links = collect($links);
    }

    public function render(): View
    {
        return view('navigation::components.desktop.desktop-dropdown-button');
    }
}
