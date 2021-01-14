<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Concerns;

use Onramplab\LaravelLogEnhancement\Logger;
use Onramplab\LaravelLogEnhancement\LogManager;
use Onramplab\LaravelLogEnhancement\Tests\TestCase;

class LoggerManagerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function logger_instance_should_be_our_custom_logger()
    {
      $manager = new LogManager($this->app);

      $logger = $manager->channel('stack');

      $this->assertInstanceOf(Logger::class, $logger);
    }
}
