<?php

namespace Luxury\Middleware;

use Phalcon\Di\Injectable;
use Phalcon\DiInterface;


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
    protected $listen = [];

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
    protected $space = [];

    /**
     * Attach all require event to make the middleware
     */
    public function attach()
    {
        $em = $this->getEventsManager();

        foreach ($this->space as $space) {
            $em->attach($space, $this);
        }

        foreach ($this->listen as $event => $callback) {
            $em->attach($event, [$this, $callback]);
        }
    }
}