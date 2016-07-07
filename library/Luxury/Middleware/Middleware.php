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
     * Middleware constructor.
     *
     * @param \Phalcon\DiInterface $di
     */
    public function __construct(DiInterface $di)
    {
        $this->setDI($di);
    }

}