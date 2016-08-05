<?php

namespace App\Http;

use App\Providers\SomeApiServices as SomeApiProvider;
use Luxury\Foundation\Application\Http;
use Luxury\Http\Middleware\Throttle as ThrottleMiddleware;
use Luxury\Foundation\Middleware\Debug as DebugMiddleware;
use Luxury\Providers\{
    Auth as AuthProvider,
    Config as ConfigProvider,
    Database as DatabaseProvider,
    Flash as FlashProvider,
    Http\Dispatcher as DispatcherProvider,
    Http\Router as RouterProvider,
    HttpClient as HttpClientProvider,
    Logger as LoggerProvider,
    Session as SessionProvider,
    Url as UrlProvider,
    View as ViewProvider
};
use Phalcon\Mvc\Router;

/**
 * Class Kernel
 *
 * @package App\Http\Controllers
 */
class Kernel extends Http
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
         * Http Client
         */
        HttpClientProvider::class,

        /*
         * Auth Service
         */
        AuthProvider::class,

        /*
         * SomeApi Service
         */
        SomeApiProvider::class
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
    public function routes($router, $base = '')
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

        $router->addGet($base . 'forward', [
            'controller' => 'index',
            'action'     => 'forward'
        ]);

        $router->addPost($base . 'auth/login', [
            'controller' => 'auth',
            'action'     => 'login'
        ]);
    }
}
