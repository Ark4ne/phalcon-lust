<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events;
use Luxury\Support\Facades\Log;
use Phalcon\Events\Event;

class Debug extends Middleware
{
    protected $space = [
        Events::APPLICATION,
        Events::DISPATCH
    ];

    /**
     * Event : application:beforeHandleRequest
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function beforeHandleRequest(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:beforeDispatchLoop
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function beforeDispatchLoop(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:beforeDispatch
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function beforeDispatch(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:beforeExecuteRoute
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function beforeExecuteRoute(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:afterInitialize
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function afterInitialize(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:afterExecuteRoute
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function afterExecuteRoute(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:afterDispatch
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function afterDispatch(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : dispatcher:afterDispatchLoop
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function afterDispatchLoop(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }

    /**
     * Event : application:afterHandleRequest
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     */
    public function afterHandleRequest(Event $event, $handler)
    {
        Log::debug('application:beforeHandleRequest : handler : ' . get_class($handler));
        Log::debug($event);
    }
}