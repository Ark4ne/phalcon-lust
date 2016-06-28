<?php

namespace Luxury\Support\Facades;

/**
 * Class Auth
 *
 * @package Luxury\Support\Facades
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }

}