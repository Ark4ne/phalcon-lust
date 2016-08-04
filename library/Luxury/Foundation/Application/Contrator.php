<?php

namespace Luxury\Foundation\Application;

use Luxury\Constants\Services;
use Luxury\Events\Listener;
use Luxury\Interfaces\Kernel;
use Luxury\Middleware\Middleware;
use Luxury\Support\Facades\Facade;
use Phalcon\Di;
use Phalcon\Di\FactoryDefault as DependencyInjection;
use Phalcon\Di\Service;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;

/**
 * Trait Contrator
 *
 * @package Luxury\Foundation\Application
 */
trait Contrator
{
    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * Construct Application
     *
     * @param $kernelClass
     */
    public function make($kernelClass)
    {
        $this->bootstrap();

        $this->setKernel(new $kernelClass());

        $this->kernel->registerServices($this);
        $this->kernel->registerMiddlewares($this);
        $this->kernel->registerRoutes($this);
    }

    /**
     * Attach an Event Listener
     *
     * @param Listener $listener
     *
     * @throws \Exception
     */
    public function attach(Listener $listener)
    {
        $listener->setDI($this->getDI());

        $listener->setEventsManager($this->getEventsManager());

        $listener->attach();
    }

    /**
     * Attach a Middleware
     *
     * @param Middleware $middleware
     *
     * @throws \Exception
     */
    public function attachMiddleware(Middleware $middleware)
    {
        $middleware->setDI($this->getDI());

        $middleware->setEventsManager($this->getEventsManager());

        $middleware->attach();
    }

    protected function bootstrap()
    {
        $em = new EventsManager;

        $this->setEventsManager($em);

        Di::reset();

        $di = $this->diClass;

        /** @var Di $di */
        $di = new $di;

        $di->setShared('app', $this);

        $di->setInternalEventsManager($em);

        $di->setShared(Services::EVENTS_MANAGER, $em);

        // Register Global Di
        Di::setDefault($di);

        // Register Di on Facade
        Facade::setDependencyInjection($di);

        // Register Di on Application
        $this->setDI($di);
    }

    /**
     * @param \Luxury\Interfaces\Kernel $kernel
     */
    private function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }
}
