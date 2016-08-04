<?php

namespace App\Cli;

use Luxury\Foundation\Kernel as KernelCore;
use Luxury\Interfaces\Kernel as KernelInterface;
use Luxury\Middleware\Debug as DebugMiddleware;
use Luxury\Providers\Cli\Dispatcher as DispatcherProvider;
use Luxury\Providers\Cli\Router as RouterProvider;
use Luxury\Providers\Config as ConfigProvider;
use Luxury\Providers\Database as DatabaseProvider;
use Luxury\Providers\HttpClient as HttpClientProvider;
use Luxury\Providers\Logger as LoggerProvider;
use Phalcon\Cli\Router;

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
        RouterProvider::class,
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
        DebugMiddleware::class
    ];

    /**
     * Register the routes of the application.
     *
     * @param Router $router
     * @param string $base
     */
    public function routes($router, $base = '')
    {
    }
}
