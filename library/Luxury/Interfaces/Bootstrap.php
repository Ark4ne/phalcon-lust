<?php

namespace Luxury\Interfaces;

use Luxury\Foundation\Application;

/**
 * Interface BootstrapInterface
 *
 * @package Luxury\Foundation\Bootstrap
 */
interface Bootstrap
{
    /**
     * @param \Luxury\Foundation\Application $app
     *
     * @return void
     */
    public function bootstrap(Application $app);
}
