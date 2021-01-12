<?php
namespace Onramplab\LaravelLogEnhancement\Concerns;

use Illuminate\Support\Facades\Log;
use Onramplab\LaravelLogEnhancement\Logger;

/**
 * @deprecated deprecated since version 0.3.0
 */
trait LogWithClassPath {
    public function debug(string $message, array $context = [])
    {
        $this->log('debug', $message, $context);
    }

    public function info(string $message, array $context = [])
    {
        $this->log('info', $message, $context);
    }

    public function notice(string $message, array $context = [])
    {
        $this->log('notice', $message, $context);
    }

    public function warning(string $message, array $context = [])
    {
        $this->log('warning', $message, $context);
    }

    public function error(string $message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    public function critical(string $message, array $context = [])
    {
        $this->log('critical', $message, $context);
    }


    public function alert(string $message, array $context = [])
    {
        $this->log('alert', $message, $context);
    }

    public function emergency(string $message, array $context = [])
    {
        $this->log('emergency', $message, $context);
    }

    protected function log(string $logLevel, string $message, array $context = [])
    {
        $logger = app()->make(Logger::class);

        $className = get_class($this);
        $context = array_merge($context, [
            'class_path' => $className,
        ]);

        $logger->{$logLevel}($message, $context);
    }
}
