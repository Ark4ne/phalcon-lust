<?php

namespace Luxury\Middleware;

use Luxury\Support\Facades\Log;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;

/**
 * Class Contract
 *
 * @package     Luxury\Middleware
 */
abstract class Middleware extends Injectable
{
    /**
     * List to event to listen.
     *
     * ex : [
     *      {eventName} => {methodCall},
     *      \Luxury\Constants\Events\Application::BOOT => 'onBoot',
     *      \Luxury\Constants\Events\Dispatch::BEFORE_DISPATCH => 'onBeforeDispatch'
     * ]
     *
     * @var string[]
     */
    protected $listen;

    /**
     * List to space to listen.
     *
     * ex : [
     *      {eventSpace},
     *      \Luxury\Constants\Events::APPLICATION,
     *      \Luxury\Constants\Events::DISPATCH,
     * ]
     *
     * @var string[]
     */
    protected $space;

    public function __construct()
    {
        Log::debug('initialization:' . get_class($this));
    }

    /**
     * Attach all require event to make the middleware
     */
    public function attach()
    {
        $em = $this->getEventsManager();

        if (!empty($this->space)) {
            foreach ($this->space as $space) {
                $em->attach($space, $this);
            }
        }

        if (!empty($this->listen)) {
            foreach ($this->listen as $event => $callback) {
                $closure = function (Event $event, $handler, $data = null) use ($callback) {
                    $this->$callback($event, $handler, $data);
                };

                $em->attach($event, \Closure::bind($closure, $this));
            }
        }
    }
}