<?php

namespace Onramplab\LaravelLogEnhancement\Handlers;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler as BaseLogglyHandler;

class LogglyHandler extends BaseLogglyHandler
{
    public function __construct($token, $tags, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($token, $level, $bubble);

        $tagsList = explode(',', $tags);
        $this->setTag($tagsList);
    }
}
