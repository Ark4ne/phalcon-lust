<?php

namespace Luxury\Middleware;

use Luxury\Middleware\Contracts\Application as ApplicationContracts;
use Phalcon\Events\Event;

/**
 * Class Throttle
 *
 * @package     Luxury\Middleware
 */
class Throttle extends Middleware implements ApplicationContracts
{
    /**
     * Event : dispatcher:beforeExecuteRoute
     *
     * @param \Phalcon\Events\Event $event
     * @param mixed                 $handler
     *
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, $handler)
    {
        // TODO 
    }
}