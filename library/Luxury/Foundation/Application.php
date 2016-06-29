<?php

namespace Luxury\Foundation;

use Luxury\Constants\Services;
use Luxury\Interfaces\Kernel;
use Luxury\Support\Facades\Facade;
use Phalcon\Di\FactoryDefault as DependencyInjection;
use Phalcon\Di\Service;
use Phalcon\Events\Manager as EventsManager;
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
     * Construct Application
     * 
     * @param $kernelName
     */
    public function make($kernelName)
    {
        $this->bootstrap();

        $this->setKernel(new $kernelName());

        $this->registerServices($this->kernel->providers());

        $this->kernel->bootstrap($this->getDI());
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
        $di->setShared('app', $this);

        $em = new EventsManager();
        
        $di->setShared(Services::EVENTS_MANAGER, $em);

        $this->setEventsManager($em);
    }

    /**
     * This methods registers the services to be used by the application
     *
     * @param array $services
     */
    protected function registerServices(array $services)
    {
        $di = $this->getDI();
        foreach ($services as $service) {
            /* @var \Luxury\Interfaces\Providable $srv */
            $srv = new $service();

            $srv->register($di);
        }
    }

    /**
     * @param \Luxury\Interfaces\Kernel $kernel
     */
    private function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }
}