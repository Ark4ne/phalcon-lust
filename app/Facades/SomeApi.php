<?php

namespace App\Facades;

use App\Constants\Services;
use Luxury\Support\Facades\Facade;

/**
 * Class SomeApi
 *
 * @package App\Facades
 *
 * @method static void doSomething()
 * @method static void doAnotherThing()
 */
class SomeApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Services::SOME_API;
    }
}