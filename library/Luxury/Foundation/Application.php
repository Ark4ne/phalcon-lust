<?php

namespace Luxury\Foundation;

use Luxury\Constants\Services;
use Luxury\Interfaces\Kernel;
use Luxury\Support\Facades\Facade;
use Phalcon\Di\FactoryDefault as DependencyInjection;
use Phalcon\Di\Service;
use Phalcon\Error\Handler as ErrorHandler;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;
use Phalcon\Mvc\Application as PhalconApp;

/**
 * Class Application
 *
 * @package Luxury\Foundation
 * @property \stdClass|\Phalcon\Config config
 */
class Application extends PhalconApp
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        ErrorHandler::register();

        parent::__construct(null);
    }


    /**
     * Construct Application
     * 
     * @param $kernelName
     */
    public function make($kernelName)
    {
        $this->bootstrap();

        $this->setKernel(new $kernelName());

        $di = $this->getDI();

        $this->kernel->registerServices($di);
        $this->kernel->registerRoutes($di);
    }


    protected function bootstrap()
    {
        $di = new DependencyInjection();

        $di->setInternalEventsManager(new EventsManager);

        // Register Di on Facade
        Facade::setDependencyInjection($di);

        // Register Di on Application
        $this->setDI($di);

        // Register Application itself on Di
        //$di->setShared('app', $this);

        $em = new EventsManager();
        
        $di->setShared(Services::EVENTS_MANAGER, $em);

        $this->setEventsManager($em);
    }

    /**
     * @param \Luxury\Interfaces\Kernel $kernel
     */
    private function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }
}