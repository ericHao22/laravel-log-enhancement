<?php

namespace Onramplab\LaravelLogEnhancement;

use Illuminate\Support\Facades\Facade;

class LaravelLogEnhancementFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-log-enhancement';
    }
}
