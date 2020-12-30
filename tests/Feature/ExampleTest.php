<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Feature;

use Onramplab\LaravelLogEnhancement\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
