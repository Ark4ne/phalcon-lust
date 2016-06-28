<?php

namespace Luxury\Foundation;

use Luxury\Constants\Services;
use Luxury\Interfaces\Kernel as KernelInterface;

/**
 * Class HttpKernel
 *
 * @package Luxury\Foundation
 */
abstract class HttpKernel implements KernelInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap(\Phalcon\DiInterface $di)
    {
        $this->routes($di->get(Services::ROUTER));
    }

    /**
     * Register the routes of the application.
     *
     * @param \Phalcon\Mvc\Router $router
     *
     * @return mixed
     */
    public abstract function routes(\Phalcon\Mvc\Router $router);
}