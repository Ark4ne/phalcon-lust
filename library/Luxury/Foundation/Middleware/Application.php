<?php

namespace Luxury\Foundation\Middleware;

use Luxury\Middleware\AfterMiddleware;
use Luxury\Middleware\BeforeMiddleware;
use Luxury\Middleware\Middleware;
use Luxury\Constants\Events\Application as AppEvent;
use Phalcon\Dispatcher;
use Phalcon\Events\Event;

abstract class Application extends Middleware
{
    protected $listen = [
        AppEvent::BEFORE_HANDLE_REQUEST => 'beforeHandleRequest',
        AppEvent::AFTER_HANDLE_REQUEST  => 'afterHandleRequest',
    ];

    /**
     * Event called before the controller execution
     *
     * @param Event      $event
     * @param Dispatcher $handler
     */
    public function beforeHandleRequest(Event $event, Dispatcher $handler)
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
    public function afterHandleRequest(Event $event, Dispatcher $handler)
    {
        if ($this instanceof AfterMiddleware) {
            $this->after($event, $handler);
        }
    }

}