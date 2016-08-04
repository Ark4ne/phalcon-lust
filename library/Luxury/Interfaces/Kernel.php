<?php

namespace Luxury\Interfaces;

use Phalcon\Application;

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
     * @param \Phalcon\Mvc\Router|\Phalcon\Cli\Router $routes
     * @param string                                  $baseUri
     *
     * @return void
     */
    public function routes($routes, $baseUri = '');

    /**
     * Register the services.
     *
     * @params Application|Luxury\Foundation\Application\Contract  $app
     *
     * @return void
     */
    public function registerServices(Application $app);

    /**
     * Register the routes.
     *
     * @params Application|Luxury\Foundation\Application\Contract  $app
     *
     * @return void
     */
    public function registerRoutes(Application $app);

    /**
     * Register the middlewares.
     *
     * @params Application|Luxury\Foundation\Application\Contract  $app
     *
     * @return void
     */
    public function registerMiddlewares(Application $app);
}
