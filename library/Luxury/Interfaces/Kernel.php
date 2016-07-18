<?php

namespace Luxury\Interfaces;

use Luxury\Foundation\Application;

/**
 * Interface KernelInterface
 *
 * @package Luxury\Interfaces
 */
interface Kernel
{
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
     * @param \Luxury\Foundation\Application $app
     *
     * @return void
     */
    public function registerServices(Application $app);

    /**
     * Register the routes.
     *
     * @param \Luxury\Foundation\Application $app
     *
     * @return void
     */
    public function registerRoutes(Application $app);

    /**
     * Register the middlewares.
     *
     * @param \Luxury\Foundation\Application $app
     *
     * @return void
     */
    public function registerMiddlewares(Application $app);
}
