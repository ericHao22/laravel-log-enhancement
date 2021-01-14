<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Concerns;

use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Mockery;
use Onramplab\LaravelLogEnhancement\Tests\TestCase;
use Onramplab\LaravelLogEnhancement\Logger;
use Psr\Log\LoggerInterface;

class LoggerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function log_should_include_class_path_and_uuid_in_context()
    {
      $this->app->instance(Logger::class, Mockery::mock(Logger::class));

      $logger = app()
        ->make(Logger::class)
        ->makePartial();

      $logger->shouldReceive('log', function ($logLevel, $message, $context) {
          return $logLevel === 'info'
            && $message === '123'
            && isSet($context['class_path'])
            && isSet($context['tracking_id']);
        })
        ->once();

      $logger->info('123');
    }
}
