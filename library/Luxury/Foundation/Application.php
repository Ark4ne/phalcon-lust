<?php

namespace Luxury\Foundation;

use Luxury\Constants\Services;
use Luxury\Error\Handler as ErrorHandler;
use Luxury\Interfaces\Kernel;
use Luxury\Support\Facades\Facade;
use Luxury\Support\Facades\Log;
use Phalcon\Di;
use Phalcon\Di\FactoryDefault as DependencyInjection;
use Phalcon\Di\Service;
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
     * @param $kernelClass
     */
    public function make($kernelClass)
    {
        $this->bootstrap();

        $this->getEventsManager()->attach('micro', function () {
            var_export(func_get_args());
        });
        $this->setKernel(new $kernelClass());

        $di = $this->getDI();

        $this->kernel->registerServices($di);
        $this->kernel->registerRoutes($di);

        $events = [
            'micro:beforeHandleRoute',
            'micro:beforeExecuteRoute',
            'micro:afterExecuteRoute',
            'micro:beforeNotFound',
            'micro:afterHandleRoute',
            'application:boot',
            'application:beforeStartModule',
            'application:afterStartModule',
            'application:beforeHandleRequest',
            'application:afterHandleRequest',
            'application:viewRender',
            'application:beforeSendResponse',
            'dispatch:beforeDispatchLoop',
            'dispatch:beforeDispatch',
            'dispatch:beforeNotFoundAction',
            'dispatch:beforeExecuteRoute',
            'dispatch:afterInitialize',
            'dispatch:afterExecuteRoute',
            'dispatch:afterDispatch',
            'dispatch:afterDispatchLoop',
            'dispatch:beforeException',
            'collection:beforeValidation',
            'collection:beforeValidationOnCreate',
            'collection:beforeValidationOnUpdate',
            'collection:validation',
            'collection:onValidationFails',
            'collection:afterValidationOnCreate',
            'collection:afterValidationOnUpdate',
            'collection:afterValidation',
            'collection:beforeSave',
            'collection:beforeUpdate',
            'collection:beforeCreate',
            'collection:afterUpdate',
            'collection:afterCreate',
            'collection:afterSave',
            'collection:notSave',
            'collection:notDeleted',
            'collection:notSaved',
        ];
        foreach ($events as $event) {
            $this->getEventsManager()
                ->attach($event, function (\Phalcon\Events\Event $event, $source = null, $data = null) {
                    echo var_export($event->getType(), true) . PHP_EOL;

                    return true;
                });
        }

    }


    protected function bootstrap()
    {
        $em = new EventsManager;

        $this->setEventsManager($em);

        Di::reset();

        $di = new DependencyInjection;

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