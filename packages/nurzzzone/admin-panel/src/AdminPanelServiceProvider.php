<?php

namespace Nurzzzone\AdminPanel;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nurzzzone\AdminPanel\Controllers\AdminController;
use Nurzzzone\AdminPanel\Support\Contracts\FromForm;
use Nurzzzone\AdminPanel\Support\Contracts\FromTable;

/**
 * @className AdminPanelServiceProvider
 * @package Nurzzzone\AdminPanel\AdminPanelServiceProvider
 */
class AdminPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/admin-panel', 'admin-panel');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/../resources/static' => public_path('vendor/admin-panel')
        ], 'admin-panel-assets');

        $this->app->booted($this->registerRoutes());
    }

    protected function registerRoutes()
    {
        return function() {
            foreach(get_declared_classes() as $className) {
                if (($reflection = new \ReflectionClass($className))->isSubclassOf(AdminController::class)) {
                    $controller = new $className;

                    if (is_null($controller->getRouteName())) {
                        throw new \RuntimeException(sprintf('%s must set routeName property value.', $className));
                    }

                    if ($className instanceof FromTable) {
                        Route::get($controller->getRouteName(), [$className, 'index']);
                    }

                    if ($className instanceof FromForm) {
                        Route::match(['GET', 'HEAD', 'POST'], $controller->getRouteName(), [$className, 'create']);
                        Route::match(['GET'. 'HEAD', 'POST'], $controller->getRouteName(), [$className, 'edit']);
                    }

                    unset($controller);
                }

                unset($reflection);
            }
        };
    }
}
