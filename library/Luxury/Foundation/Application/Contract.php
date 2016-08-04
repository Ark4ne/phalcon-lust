<?php

namespace Luxury\Foundation\Application;

use Luxury\Events\Listener;
use Luxury\Middleware\Middleware;

/**
 * Class Contract
 *
 * @package Luxury\Foundation\Application
 */
interface Contract
{
    /**
     * @param $kernelClass
     *
     * @return mixed
     */
    public function make($kernelClass);

    /**
     * @param \Luxury\Events\Listener $listener
     *
     * @return mixed
     */
    public function attach(Listener $listener);

    /**
     * @param \Luxury\Middleware\Middleware $middleware
     *
     * @return mixed
     */
    public function attachMiddleware(Middleware $middleware);
}
