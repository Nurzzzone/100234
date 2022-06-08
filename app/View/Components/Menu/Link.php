<?php

namespace App\View\Components\Menu;

class Link extends MenuElement
{
    /**
     * @var string
     */
    public $href;

    public function __construct(string $name, string $href, ?string $icon = null)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->href = $href;
    }

    public function render()
    {
        return view('components.menu.link');
    }
}
