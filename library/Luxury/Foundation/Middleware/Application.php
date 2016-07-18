<?php

namespace Luxury\Foundation\Middleware;

use Luxury\Middleware\AfterMiddleware;
use Luxury\Middleware\BeforeMiddleware;
use Luxury\Middleware\Middleware;
use Luxury\Constants\Events\Application as AppEvent;

abstract class Application extends Middleware
{
    public final function __construct()
    {
        if ($this instanceof BeforeMiddleware) {
            $this->listen[AppEvent::BEFORE_HANDLE_REQUEST] = 'before';
        }
        if ($this instanceof AfterMiddleware) {
            $this->listen[AppEvent::AFTER_HANDLE_REQUEST] = 'after';
        }
    }
}
