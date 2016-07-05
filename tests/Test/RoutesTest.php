<?php

namespace Test;

use Luxury\Constants\Services;
use Phalcon\Di;
use Phalcon\Mvc\Router;

/**
 * Class UnitTest
 */
class RoutesTest extends \TestCase
{
    /**
     */
    public function routesProvider()
    {
        $routes = [
            '/' => true,
        ];

        $_routes = [];
        foreach ($routes as $route => $expected) {
            $_routes[$route] = [$route, $expected];
        }

        return $_routes;
    }

    /**
     * @test
     * @dataProvider routesProvider
     *
     * @param $route
     * @param $expected
     */
    public function testRoutes($route, $expected)
    {
        $di = $this->getDI();

        /* @var Router $router */
        $router = $di->getShared(Services::ROUTER);

        $router->handle($route);

        $this->assertEquals($expected, $router->wasMatched());
    }
}