<?php

namespace Luxury\Foundation;

use Luxury\Interfaces\Kernel as KernelInterface;

/**
 * Class HttpKernel
 *
 * @package Luxury\Foundation
 */
abstract class Kernel implements KernelInterface
{
    /**
     * Return the Provider List to load.
     *
     * @var string[]
     */
    protected $providers = [];

    /**
     * Return the Middleware List to load.
     *
     * @var string[]
     */
    protected $middlewares = [];

    /**
     * This methods registers the services to be used by the application
     *
     * @param Application $app
     */
    public function registerServices(Application $app)
    {
        $di = $app->getDI();

        foreach ($this->providers as $provider) {
            /* @var \Luxury\Interfaces\Providable $srv */
            $srv = new $provider();

            $srv->register($di);
        }
    }

    /**
     * This methods registers the routes of the application
     *
     * @param Application $app
     */
    public function registerRoutes(Application $app)
    {
        $router = $app->router;

        $config = $app->config;

        $base = isset($config->application->baseUri) ? $config->application->baseUri : '';

        $this->routes($router, $base);
    }

    /**
     * This methods registers the middlewares to be used by the application
     *
     * @param Application $app
     */
    public function registerMiddlewares(Application $app)
    {
        foreach ($this->middlewares as $middleware) {
            $app->attachMiddleware(new $middleware);
        }
    }
}