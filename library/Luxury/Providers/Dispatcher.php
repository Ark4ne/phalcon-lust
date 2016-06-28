<?php

namespace Luxury\Providers;

use Luxury\Constants\Services;
use Luxury\Interfaces\Providable;
use Phalcon\DiInterface;

/**
 * Class Dispatcher
 *
 * @package Luxury\Bootstrap\Services
 */
class Dispatcher implements Providable
{
    /**
     * @param \Phalcon\DiInterface $di
     */
    public function register(DiInterface $di)
    {
        $di->setShared(Services::DISPATCHER, function () {
            /* @var \Phalcon\Di $this */
            $dispatcher = new \Phalcon\Mvc\Dispatcher();

            $dispatcher->setEventsManager($this->get(Services::EVENTS_MANAGER));

            return $dispatcher;
        });
    }
}