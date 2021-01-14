<?php

namespace Onramplab\LaravelLogEnhancement;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Psr\Log\LoggerInterface;

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
        // Register facade
        // $this->app->singleton('laravel-log-enhancement', function () {
        //     return new LaravelLogEnhancement;
        // });
        $this->app->singleton(Logger::class, function (Application $app) {
            return new Logger($app->make(LoggerInterface::class));
        });

        $this->app->singleton('laravel-log-enhancement-logger', function ($app) {
            return new LogManager($app);
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
