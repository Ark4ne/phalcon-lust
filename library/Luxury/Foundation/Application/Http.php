<?php

namespace Luxury\Foundation\Application;

use Luxury\Error\Handler as ErrorHandler;
use Luxury\Foundation\Application\Contract as ApplicationContract;
use Phalcon\Mvc\Application;

/**
 * Class Http
 *
 * @package     Luxury\Foundation\Application
 */
class Http extends Application implements ApplicationContract
{
    use Contrator;

    /**
     * @var string
     */
    protected $diClass = \Phalcon\Di\FactoryDefault::class;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        ErrorHandler::register();

        parent::__construct(null);
    }
}
