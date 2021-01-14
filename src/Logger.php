<?php

namespace Onramplab\LaravelLogEnhancement;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Log\Logger as IlluminateLogger;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class Logger extends IlluminateLogger
{
    /**
     * @var string
     */
    protected $debugId;

    /**
     * LoggerInterface
     */
    protected $logger;

    /**
     * @var string
     */
    protected $channelName;

    /**
     * Create a new log writer instance.
     *
     * @param  \Psr\Log\LoggerInterface  $logger
     * @param  \Illuminate\Contracts\Events\Dispatcher|null  $dispatcher
     * @return void
     */
    public function __construct(LoggerInterface $logger, Dispatcher $dispatcher = null)
    {
        $this->logger = $logger;
        $this->dispatcher = $dispatcher;
        $this->debugId = Uuid::uuid4()->toString();
    }

    /**
     * Write a message to the log.
     *
     * @param  string  $level
     * @param  string  $message
     * @param  array  $context
     * @return void
     */
    protected function writeLog($level, $message, $context)
    {
        // attach class_path
        // NOTE: it's hardcoded, should find a better way to get caller class
        $caller = debug_backtrace();
        $caller = $caller[4];
        $context['class_path'] = $caller['class'];

        // attach tracking_id
        $context['tracking_id'] = $this->debugId;

        parent::writeLog($level, $message, $context);
    }
}
