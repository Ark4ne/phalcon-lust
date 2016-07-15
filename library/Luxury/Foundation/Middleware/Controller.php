<?php

namespace Luxury\Foundation\Middleware;

use Luxury\Constants\Events\Dispatch;
use Luxury\Middleware\AfterMiddleware;
use Luxury\Middleware\BeforeMiddleware;
use Luxury\Middleware\FinishMiddleware;
use Luxury\Middleware\Middleware;

abstract class Controller extends Middleware
{
    public final function __construct()
    {
        if ($this instanceof BeforeMiddleware) {
            $this->listen[Dispatch::BEFORE_EXECUTE_ROUTE] = 'before';
        }
        if ($this instanceof AfterMiddleware) {
            $this->listen[Dispatch::AFTER_EXECUTE_ROUTE] = 'after';
        }
        if ($this instanceof FinishMiddleware) {
            $this->listen[Dispatch::AFTER_EXECUTE_ROUTE] = 'finish';
        }
    }
}