<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events\Dispatch;
use Phalcon\Events\Event;

/**
 * Class DisptacherMiddleware
 *
 * @package Luxury\Middleware
 */
abstract class MiddlewareDisptacher extends Middleware
{
    protected $listen = [
        Dispatch::BEFORE_EXECUTE_ROUTE => 'beforeDispatch',
        Dispatch::AFTER_EXECUTE_ROUTE  => 'afterDispatch',
    ];

    /**
     * Event : dispatcher:beforeDispatch
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function beforeDispatch(Event $event, $handler)
    {
        if ($this instanceof BeforeMiddleware) {
            $this->before($event, $handler);
        }
    }

    /**
     * Event : dispatcher:afterDispatch
     *
     * @param Event $event
     * @param mixed $handler
     */
    public function afterDispatch(Event $event, $handler)
    {
        if ($this instanceof AfterMiddleware) {
            $this->after($event, $handler);
        }
    }
}