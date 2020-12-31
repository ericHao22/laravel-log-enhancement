<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Concerns;

use Onramplab\LaravelLogEnhancement\Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Onramplab\LaravelLogEnhancement\Concerns\LogWithClassPath;

class LogWithClassPathTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function log_should_include_class_path_in_context()
    {
      $this->object = new Fake();
      Log::spy();

      $this->object->run();

      Log
        ::shouldHaveReceived('log', function ($logLevel, $message, $context) {
          return $logLevel === 'info'
            && $message === 'Test'
            && $context['class_path'] === 'Onramplab\LaravelLogEnhancement\Tests\Unit\Concerns\Fake';
        })
        ->once();
    }
}

class Fake {
  use LogWithClassPath;

  public function run()
  {
    $this->info('Test');
  }
}
