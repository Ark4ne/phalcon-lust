<?php

namespace Test;

use Luxury\Constants\Events;
use Luxury\Foundation\Middleware\Application as ApplicationMiddleware;
use Luxury\Foundation\Middleware\Controller as ControllerMiddleware;
use Luxury\Foundation\Middleware\Disptacher as DisptacherMiddleware;
use Luxury\Middleware\AfterMiddleware;
use Luxury\Middleware\BeforeMiddleware;
use Luxury\Middleware\FinishMiddleware;
use Luxury\Middleware\InitMiddleware;
use Support\Middlewarize;
use Support\TestListenable;
use Support\TestListenize;

/**
 * Class MiddlewareTest
 *
 * @package Test
 */
class MiddlewareTest extends \TestCase
{
    public function testControllerMiddleware()
    {
        // GIVEN
        $middleware = new TestControllerMiddleware();

        $this->app->attachMiddleware($middleware);

        // WHEN
        $this->app->handle('/');

        // THEN
        $this->assertFalse($middleware->hasView('init'));
        $this->assertTrue($middleware->hasView('before'));
        $this->assertTrue($middleware->hasView('after'));
        $this->assertTrue($middleware->hasView('finish'));

        $this->assertEquals(0, count($middleware->getView('init')));
        $this->assertEquals(1, count($middleware->getView('before')));
        $this->assertEquals(1, count($middleware->getView('after')));
        $this->assertEquals(1, count($middleware->getView('finish')));
    }

    public function testDispatchMiddleware()
    {
        // GIVEN
        $middleware = new TestDispatchMiddleware();

        $this->app->attachMiddleware($middleware);

        // WHEN
        $this->app->handle('/');

        // THEN
        $this->assertTrue($middleware->hasView('init'));
        $this->assertTrue($middleware->hasView('before'));
        $this->assertTrue($middleware->hasView('after'));
        $this->assertTrue($middleware->hasView('finish'));

        $this->assertEquals(1, count($middleware->getView('init')));
        $this->assertEquals(1, count($middleware->getView('before')));
        $this->assertEquals(1, count($middleware->getView('after')));
        $this->assertEquals(1, count($middleware->getView('finish')));
    }

    public function testApplicationMiddleware()
    {
        // GIVEN
        $middleware = new TestApplicationMiddleware();

        $this->app->attachMiddleware($middleware);

        // WHEN
        $this->app->handle('/');

        // THEN
        $this->assertFalse($middleware->hasView('init'));
        $this->assertTrue($middleware->hasView('before'));
        $this->assertTrue($middleware->hasView('after'));
        $this->assertFalse($middleware->hasView('finish'));

        $this->assertEquals(0, count($middleware->getView('init')));
        $this->assertEquals(1, count($middleware->getView('before')));
        $this->assertEquals(1, count($middleware->getView('after')));
        $this->assertEquals(0, count($middleware->getView('finish')));
    }
}


class TestControllerMiddleware extends ControllerMiddleware implements
    TestListenable,
    BeforeMiddleware,
    AfterMiddleware,
    FinishMiddleware
{
    use TestListenize, Middlewarize;
}

class TestDispatchMiddleware extends DisptacherMiddleware implements
    TestListenable,
    InitMiddleware,
    BeforeMiddleware,
    AfterMiddleware,
    FinishMiddleware
{
    use TestListenize, Middlewarize;
}

class TestApplicationMiddleware extends ApplicationMiddleware implements
    TestListenable,
    BeforeMiddleware,
    AfterMiddleware
{
    use TestListenize, Middlewarize;
}