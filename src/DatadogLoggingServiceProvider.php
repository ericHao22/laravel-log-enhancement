<?php

namespace Onramplab\LaravelLogEnhancement;

use Illuminate\Support\ServiceProvider;

class DatadogLoggingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // can get function after install php datadog-setup
        if (!function_exists('\DDTrace\current_context')) {
            return;
        }

        // Get the Monolog instance
        $monolog = logger()->getLogger();
        if (!$monolog instanceof \Monolog\Logger) {
            return;
        }

        foreach ($monolog->getHandlers() as $handler) {
            if (method_exists($handler, 'setFormatter')) {
                $handler->setFormatter(new \Monolog\Formatter\JsonFormatter());
            }
        }

        // Inject the trace and span ID to connect the log entry with the APM trace
        $monolog->pushProcessor(function ($record) {
            $context = \DDTrace\current_context();
            $record->extra['dd'] = [
                'trace_id' => $context['trace_id'],
                'span_id'  => $context['span_id'],
            ];
            return $record;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}