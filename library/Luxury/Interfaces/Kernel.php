<?php

namespace Luxury\Interfaces;

/**
 * Interface KernelInterface
 *
 * @package Luxury\Interfaces
 */
interface Kernel
{
    /**
     * Return the Services to load.
     *
     * @return string[]
     */
    public function providers();

    /**
     * Register the routes of the application.
     *
     * @param \Phalcon\Mvc\Router $routes
     * @param string              $baseUri
     *
     * @return void
     */
    public function routes(\Phalcon\Mvc\Router $routes, $baseUri = '');

    /**
     * Register the services.
     *
     * @param \Phalcon\DiInterface $di
     *
     * @return \string[]
     */
    public function registerServices(\Phalcon\DiInterface $di);

    /**
     * Register the routes.
     *
     * @param \Phalcon\DiInterface $di
     *
     * @return \string[]
     */
    public function registerRoutes(\Phalcon\DiInterface $di);
}