<?php

namespace Luxury\Support\Facades;

use Phalcon\DiInterface;
use RuntimeException;

/**
 * Class Facade
 *
 * @see     Laravel 5.2 Illuminate\Support\Facades\Facade
 *
 * @package Luxury\Support\Facades
 */
abstract class Facade
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected static $di;

    /**
     * The resolved object instances.
     *
     * @var array
     */
    protected static $resolvedInstance;

    /**
     * @param \Phalcon\DiInterface $di
     */
    public static function setDependencyInjection(DiInterface $di)
    {
        self::$di = $di;
    }

    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string $method
     * @param  array  $args
     *
     * @return mixed
     * @throws RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            case 5:
                return $instance->$method($args[0], $args[1], $args[2], $args[3], $args[4]);

            default:
                return call_user_func_array([$instance, $method], $args);
        }
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string|object $name
     *
     * @return mixed
     * @throws RuntimeException
     */
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        return static::$resolvedInstance[$name] = static::$di->get($name);
    }
}
