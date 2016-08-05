<?php

namespace Luxury\Foundation\Application;

use Luxury\Foundation\Kernelize;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault as Di;

/**
 * Class Http
 *
 * @package Luxury\Foundation\Application
 */
abstract class Http extends Application
{
    use Kernelize;

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
     * The DependencyInjection class to use.
     *
     * @var string
     */
    protected $dependencyInjection = Di::class;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
    }
}
