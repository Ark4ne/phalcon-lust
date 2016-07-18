<?php

namespace Luxury\Middleware;
use Phalcon\Events\Event;

/**
 * Interface MiddlewareInterface
 *
 * @package Luxury\Middleware
 */
interface MiddlewareInterface
{
    /**
     * Event : application:beforeHandleRequest
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onBeforeHandleRequest(Event $event, $handler);

    /**
     * Event : dispatcher:beforeDispatchLoop
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onBeforeDispatchLoop(Event $event, $handler);

    /**
     * Event : dispatcher:beforeDispatch
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onBeforeDispatch(Event $event, $handler);

    /**
     * Event : dispatcher:beforeExecuteRoute
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onBeforeExecuteRoute(Event $event, $handler);

    /**
     * Event : dispatcher:afterInitialize
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onAfterInitialize(Event $event, $handler);

    /**
     * Event : dispatcher:afterExecuteRoute
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onAfterExecuteRoute(Event $event, $handler);

    /**
     * Event : dispatcher:afterDispatch
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return \Closure|null
     */
    public function onAfterDispatch(Event $event, $handler);

    /**
     * Event : dispatcher:afterDispatchLoop
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onAfterDispatchLoop(Event $event, $handler);

    /**
     * Event : application:afterHandleRequest
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return
     */
    public function onAfterHandleRequest(Event $event, $handler);
}
