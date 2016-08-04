<?php

namespace Luxury\Interfaces;

use Phalcon\Application;

/**
 * Interface BootstrapInterface
 *
 * @package Luxury\Foundation\Bootstrap
 */
interface Bootstrap
{
    /**
     * @params Application|Luxury\Foundation\Application\Contract $app
     *
     * @return void
     */
    public function bootstrap(Application $app);
}
