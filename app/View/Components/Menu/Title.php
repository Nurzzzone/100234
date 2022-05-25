<?php

namespace App\View\Components\Menu;

class Title extends MenuElement
{
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.menu.title');
    }
}
