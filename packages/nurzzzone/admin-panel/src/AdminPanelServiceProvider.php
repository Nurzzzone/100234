<?php

namespace Nurzzzone\AdminPanel;

use Illuminate\Support\ServiceProvider;

class AdminPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin-panel');
    }

    public function register()
    {
        //
    }
}
