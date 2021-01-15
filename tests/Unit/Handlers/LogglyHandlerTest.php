<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Handlers;

use Onramplab\LaravelLogEnhancement\Tests\TestCase;
use Mockery;
use Onramplab\LaravelLogEnhancement\Handlers\LogglyHandler;

class LogglyHandlerTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function constructor_should_support_tags()
    {
        $this->handler = Mockery::mock(LogglyHandler::class)->makePartial();

        $this->handler->shouldReceive('setTag')->with(['tag1', 'tag2'])->once();

        $this->handler->__construct('test', 'tag1,tag2');
    }
}
