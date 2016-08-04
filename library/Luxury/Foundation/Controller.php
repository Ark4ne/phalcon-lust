<?php

namespace Luxury\Foundation;

use Luxury\Middleware\Middleware;

/**
 * Class Controller
 *
 * @package Luxury\Foundation
 *
 * @property-read \Phalcon\Mvc\Application|\Luxury\Foundation\Application\Contract $app
 */
abstract class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * Event called on controller construction
     *
     * Register middleware here.
     */
    abstract protected function onConstruct();

    /**
     * Attach a middleware
     *
     * @param Middleware $middleware
     */
    protected function middleware(Middleware $middleware)
    {
        $this->app->attach($middleware);
    }
}
