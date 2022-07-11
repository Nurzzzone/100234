<?php

namespace Nurzzzone\AdminPanel\View\Components\Menu;

use Illuminate\View\Component;

abstract class MenuElement extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var ?string
     */
    public $icon;
}
