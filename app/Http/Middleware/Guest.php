<?php

namespace App\Http\Middleware;

use Luxury\Middleware\BeforeMiddleware;
use Luxury\Middleware\MiddlewareController;
use Luxury\Support\Facades\Auth;
use Phalcon\Http\Client\Exception;

class Guest extends MiddlewareController implements BeforeMiddleware
{

    /**
     * Called before the execution of handler
     *
     * @param \Phalcon\Events\Event|mixed $event
     * @param \Phalcon\Dispatcher|mixed   $source
     * @param mixed|null                  $data
     *
     * @return bool
     * @throws Exception
     */
    public function before($event, $source, $data = null)
    {
        if (Auth::check()) {
            throw new Exception('User already logged in.');
        }

        return true;
    }
}