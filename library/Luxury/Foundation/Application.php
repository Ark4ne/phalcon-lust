<?php

namespace Luxury\Foundation;

class Application
{
    /**
     * @param $kernelClass
     *
     * @return \Phalcon\Application
     */
    public function make($kernelClass)
    {
        /** @var \Phalcon\Application|Kernelize $kernel */
        $kernel = new $kernelClass;

        $kernel->bootstrap();

        $kernel->registerServices();
        $kernel->registerMiddlewares();
        $kernel->registerRoutes();

        return $kernel;
    }
}