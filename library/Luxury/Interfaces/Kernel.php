<?php

namespace Luxury\Interfaces;

use Phalcon\DiInterface;

/**
 * Interface KernelInterface
 *
 * @package Luxury\Interfaces
 */
interface Kernel
{
    /**
     * @param \Phalcon\DiInterface $di
     */
    public function bootstrap(DiInterface $di);

    /**
     * Return the Services to load.
     *
     * @return string[]
     */
    public function providers();
}