<?php

namespace Luxury\Middleware;

use Luxury\Constants\Events as EventSpaces;
use Luxury\Support\Facades\Log;
use Phalcon\Events\Event;

/**
 * Class Wtf
 *
 * @package     Luxury\Middleware
 */
class Wtf extends Middleware
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
     * @throws \Exception
     */
    public function beforeExecuteRoute(Event $event, $handler)
    {
        Log::alert(__METHOD__);

        throw new \Exception;
    }
}