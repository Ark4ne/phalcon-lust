<?php

namespace App\Http;

use Luxury\Foundation\Kernel as CoreKernel;
use Luxury\Interfaces\Kernel as KernelInterface;
use Phalcon\Mvc\Router;

/**
 * Class Kernel
 *
 * @package App\Http\Controllers
 */
class Kernel extends CoreKernel implements KernelInterface
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
            \Luxury\Providers\Dispatcher::class,
            \Luxury\Providers\Database::class,
            /*
             * Service provided by the Phalcon\Di\FactoryDefault
             *
            \Luxury\Providers\Models::class,
            \Luxury\Providers\Cookies::class,
            \Luxury\Providers\Filter::class,
            \Luxury\Providers\Escaper::class,
            \Luxury\Providers\Security::class,
            \Luxury\Providers\Crypt::class,
            \Luxury\Providers\Annotations::class,
            /**/

            /*
             * Auth Service
             */
            \Luxury\Providers\Auth::class
        ];
    }

    /**
     * Register the routes of the application.
     *
     * @param \Phalcon\Mvc\Router $router
     * @param string              $base
     */
    public function routes(\Phalcon\Mvc\Router $router, $base = '')
    {
        $router->setDefaultNamespace('App\Http\Controllers');

        $router->notFound([
            'controller' => 'errors',
            'action'     => 'http404'
        ]);

        $router->addGet($base, [
            'controller' => 'index',
            'action'     => 'index'
        ]);

        $router->addPost($base . '/auth/login', [
            'controller' => 'auth',
            'action'     => 'login'
        ]);
    }
}