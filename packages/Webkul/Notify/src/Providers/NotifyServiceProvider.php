<?php

namespace Webkul\Notify\Providers;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void{
        $this->app->register(ModuleServiceProvider::class);
        $this->app->register(EventServiceProvider::class);

        $this->loadMigrationsFrom(__DIR__ .'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/admin-routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/shop-routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'notify');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'notify');
    }
}