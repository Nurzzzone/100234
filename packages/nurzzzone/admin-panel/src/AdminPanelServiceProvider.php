<?php

namespace Nurzzzone\AdminPanel;

use Illuminate\Support\ServiceProvider;

class AdminPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/admin-panel', 'admin-panel');

        $this->publishes([
            __DIR__ . '/../resources/js' => public_path('vendor/admin-panel/js')
        ], 'admin-panel-assets');
    }

    public function register()
    {
        //
    }
}
