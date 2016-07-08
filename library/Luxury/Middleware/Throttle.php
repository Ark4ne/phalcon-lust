<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events as EventSpaces;
use Luxury\Support\Facades\Log;
use Phalcon\Events\Event;

/**
 * Class Throttle
 *
 * @package     Luxury\Middleware
 */
class Throttle extends Middleware
{
    protected $space = [
        EventSpaces::DISPATCH
    ];

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
        Log::notice(__METHOD__);
    }
}