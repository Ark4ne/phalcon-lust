<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events\Dispatch;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;

abstract class MiddlewareController extends Middleware
{
    protected $listen = [
        Dispatch::BEFORE_EXECUTE_ROUTE => 'beforeExecuteRoute',
        Dispatch::AFTER_EXECUTE_ROUTE  => 'afterExecuteRoute',
    ];

    /**
     * Event called before the controller execution
     *
     * @param Event      $event
     * @param Dispatcher $handler
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $handler)
    {
        if ($this instanceof BeforeMiddleware) {
            $this->before($event, $handler);
        }
    }

    /**
     * Event called after the controller execution
     *
     * @param Event      $event
     * @param Dispatcher $handler
     */
    public function afterExecuteRoute(Event $event, Dispatcher $handler)
    {
        if ($this instanceof AfterMiddleware) {
            $this->after($event, $handler);
        }
    }
}