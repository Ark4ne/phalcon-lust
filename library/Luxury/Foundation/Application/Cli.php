<?php

namespace Luxury\Foundation\Application;

use Luxury\Error\Handler as ErrorHandler;
use Luxury\Foundation\Application\Contract as ApplicationContract;
use Phalcon\Cli\Console;

/**
 * Class Cli
 *
 * @package Luxury\Foundation\Application
 */
class Cli extends Console implements ApplicationContract
{
    use Contrator;

    /**
     * @var string
     */
    protected $diClass = \Phalcon\Di\FactoryDefault\Cli::class;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        ErrorHandler::register();

        parent::__construct(null);
    }
}
