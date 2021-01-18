<?php

namespace Onramplab\LaravelLogEnhancement;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Queue;

class LaravelLogEnhancementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/LaravelLogEnhancement.php', 'laravel-log-enhancement');

        $this->publishConfig();

        // $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-log-enhancement');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->registerRoutes();
        $this->registerHooks();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
    * Get route group configuration array.
    *
    * @return array
    */
    private function routeConfiguration()
    {
        return [
            'namespace'  => "Onramplab\LaravelLogEnhancement\Http\Controllers",
            'middleware' => 'api',
            'prefix'     => 'api'
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-log-enhancement-logger', function (Application $app) {
            return new LogManager($app);
        });
    }

    public function registerHooks()
    {
        Queue::before(function () {
            $this->app->forgetInstance('laravel-log-enhancement-logger');
            Facade::clearResolvedInstance('laravel-log-enhancement-logger');
        });
    }

    /**
     * Publish Config
     *
     * @return void
     */
    public function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/LaravelLogEnhancement.php' => config_path('LaravelLogEnhancement.php'),
            ], 'config');
        }
    }
}
