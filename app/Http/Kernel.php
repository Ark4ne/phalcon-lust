<?php

namespace App\Http;

use Luxury\Foundation\HttpKernel;
use Luxury\Interfaces\Kernel as KernelInterface;
use Phalcon\Di;
use Phalcon\Mvc\Router;

/**
 * Class Kernel
 *
 * @package App\Http\Controllers
 */
class Kernel extends HttpKernel implements KernelInterface
{
    /**
     * Return Services to load.
     *
     * @return string[]
     */
    public function providers()
    {
        return [
            /*
             * Basic Configuration
             */
            \Luxury\Providers\Config::class,
            \Luxury\Providers\Logger::class,
            \Luxury\Providers\Url::class,
            \Luxury\Providers\Flash::class,
            \Luxury\Providers\Session::class,
            \Luxury\Providers\Router::class,
            \Luxury\Providers\View::class,
            /*
             * Service provided by the Phalcon\Di\FactoryDefault
             *
            \Luxury\Providers\Dispatcher::class,
            \Luxury\Providers\Database::class,
            \Luxury\Providers\Models::class,
            \Luxury\Providers\Cookies::class,
            \Luxury\Providers\Filter::class,
            \Luxury\Providers\Escaper::class,
            \Luxury\Providers\Security::class,
            \Luxury\Providers\Crypt::class,
            \Luxury\Providers\Annotations::class,
            */

            /*
             * You're Providers
             */
            \App\Providers\SomeApiServices::class
        ];
    }

    /**
     * Register the routes of the application.
     *
     * @param \Phalcon\Mvc\Router $router
     *
     * @return mixed
     */
    public function routes(Router $router)
    {
        $router->notFound([
            'namespace'  => 'App\Http\Controllers',
            'controller' => 'errors',
            'action'     => 'http404'
        ]);

        $router->addGet('/', [
            'namespace'  => 'App\Http\Controllers',
            'controller' => 'index',
            'action'     => 'index'
        ]);
    }
}