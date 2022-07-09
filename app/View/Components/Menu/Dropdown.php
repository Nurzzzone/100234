<?php

namespace App\View\Components\Menu;

class Dropdown extends MenuElement
{
    /**
     * @var array
     */
    public $children;

    public function __construct(string $name, string $icon, array $children)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->children = $children;
    }

    public function render()
    {
        return view('admin-panel::components.menu.dropdown');
    }
}
