<?php

namespace App\Providers;

use App\View\Components\Menu\Dropdown;
use App\View\Components\Menu\Link;
use App\View\Components\Menu\Title;
use App\View\Components\ModalContent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('modal-content', ModalContent::class);
        Blade::component('link', Link::class);
        Blade::component('title', Title::class);
        Blade::component('dropdown', Dropdown::class);
    }
}
