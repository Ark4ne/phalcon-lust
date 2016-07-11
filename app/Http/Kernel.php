<?php

namespace App\Http;

use Luxury\Foundation\Kernel as KernelCore;
use Luxury\Interfaces\Kernel as KernelInterface;
use Luxury\Middleware\Debug as DebugMiddleware;
use Luxury\Middleware\Throttle as ThrottleMiddleware;
use Luxury\Providers\Auth as AuthProvider;
use Luxury\Providers\Config as ConfigProvider;
use Luxury\Providers\Database as DatabaseProvider;
use Luxury\Providers\Dispatcher as DispatcherProvider;
use Luxury\Providers\Flash as FlashProvider;
use Luxury\Providers\Logger as LoggerProvider;
use Luxury\Providers\Router as RouterProvider;
use Luxury\Providers\Session as SessionProvider;
use Luxury\Providers\Url as UrlProvider;
use Luxury\Providers\View as ViewProvider;
use Phalcon\Mvc\Router;

/**
 * Class Kernel
 *
 * @package App\Http\Controllers
 */
class Kernel extends KernelCore implements KernelInterface
{
    /**
     * Return the Provider List to load.
     *
     * @var string[]
     */
    protected $providers = [
        /*
         * Basic Configuration
         */
        ConfigProvider::class,
        LoggerProvider::class,
        UrlProvider::class,
        FlashProvider::class,
        SessionProvider::class,
        RouterProvider::class,
        ViewProvider::class,
        DispatcherProvider::class,
        DatabaseProvider::class,
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
        AuthProvider::class,

        /*
         * SomeApi Service
         */
        \App\Providers\SomeApiServices::class
    ];

    /**
     * Return the Middleware List to load.
     *
     * @var string[]
     */
    protected $middlewares = [
        DebugMiddleware::class,
        ThrottleMiddleware::class
    ];

    /**
     * Register the routes of the application.
     *
     * @param Router $router
     * @param string $base
     */
    public function routes(Router $router, $base = '')
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

        $router->addPost($base . 'auth/login', [
            'controller' => 'auth',
            'action'     => 'login'
        ]);
    }
}