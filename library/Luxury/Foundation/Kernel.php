<?php

namespace Luxury\Foundation;

use Luxury\Constants\Services;
use Luxury\Interfaces\Kernel as KernelInterface;

/**
 * Class HttpKernel
 *
 * @package Luxury\Foundation
 */
abstract class Kernel implements KernelInterface
{
    /**
     * This methods registers the services to be used by the application
     *
     * @param \Phalcon\DiInterface $di
     *
     * @return \string[]|void
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        $services = $this->providers();
        foreach ($services as $service) {
            /* @var \Luxury\Interfaces\Providable $srv */
            $srv = new $service();

            $srv->register($di);
        }
    }

    /**
     * This methods registers the routes of the application
     *
     * @param \Phalcon\DiInterface $di
     *
     * @return \string[]|void
     */
    public function registerRoutes(\Phalcon\DiInterface $di)
    {
        /* @var \Phalcon\Mvc\Router $router */
        $router = $di->getShared(Services::ROUTER);

        /* @var \Phalcon\Config $config */
        $config = $di->getShared(Services::CONFIG);

        $base = isset($config->application->baseUri) ? $config->application->baseUri : '';

        $this->routes($router, $base);
    }
}