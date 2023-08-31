<?php

namespace Onramplab\LaravelLogEnhancement\Tests\Unit\Handlers;

use Onramplab\LaravelLogEnhancement\Tests\TestCase;
use Onramplab\LaravelLogEnhancement\Handlers\DatadogHandler;
use ReflectionClass;
use ReflectionProperty;

class DatadogHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function construct_should_init()
    {
        $handler = new DatadogHandler(
            'my-api-key',
            'us5',
            [
                'source' => 'laravel',
                'service' => 'my-service',
                'hostname' => 'my-host',
                'tags' => 'env:local',
            ]
        );

        $properties = $this->getPrivateProperties($handler);

        $this->assertEquals('my-api-key', $properties['key']);
        $this->assertEquals('us5.datadoghq.com', $properties['apiHost']);
        $this->assertEquals('laravel', $properties['attributes']['source']);
        $this->assertEquals('my-service', $properties['attributes']['service']);
        $this->assertEquals('my-host', $properties['attributes']['hostname']);
        $this->assertEquals('env:local', $properties['attributes']['tags']);
    }

    private function getPrivateProperties($object)
    {
        $reflection = new ReflectionClass($object);
        $properties = [];

        foreach ($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {
            $property->setAccessible(true);
            $properties[$property->getName()] = $property->getValue($object);
        }

        return $properties;
    }
}
