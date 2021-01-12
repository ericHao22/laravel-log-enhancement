<?php

namespace Onramplab\LaravelLogEnhancement;

use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class Logger
{
    protected $debugId;
    protected $logger;

    /**
     * Create an instance of the QueryLogger class
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return void
     *
     * @throws \Ramsey\Uuid\Exception\UnsatisfiedDependencyException
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->debugId = Uuid::uuid4()->toString();
        //
    }

    public function __call($name, $arguments)
    {
        $message = $arguments[0];
        $context = $arguments[1] ?? [];

        // attach caller class
        $caller = debug_backtrace();
        $caller = $caller[2];
        $context['class_path'] = $caller['class'];

        // attach tracking_id
        $context['tracking_id'] = $this->debugId;

        $this->logger->log($name, $message, $context);
    }
}
