<?php

namespace Nurzzzone\AdminPanel\View\Components\Menu;

class Title extends MenuElement
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('admin-panel::components.menu.title');
    }
}
