<?php

namespace Nurzzzone\AdminPanel;

use Illuminate\Support\ServiceProvider;

class AdminPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/admin-panel', 'admin-panel');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/static' => public_path('vendor/admin-panel')
        ], 'admin-panel-assets');
    }

    public function register()
    {
        //
    }
}
