<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Concerns;

use Illuminate\Support\Facades\Log;
use Onramplab\LaravelLogEnhancement\Tests\TestCase;
use Onramplab\LaravelLogEnhancement\Logger;

class LoggerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function log_should_include_class_path_and_uuid_in_context()
    {
      Log::spy();
      $logger = app()->make(Logger::class);

      $logger->info('123');

      Log
        ::shouldHaveReceived('log', function ($logLevel, $message, $context) {
          return $logLevel === 'info'
            && $message === '123'
            && isSet($context['class_path'])
            && isSet($context['tracking_id']);
        })
        ->once();
    }
}
