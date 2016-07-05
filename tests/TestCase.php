<?php

use Phalcon\Di;

/**
 * Class UnitTestCase
 */
abstract class TestCase extends \Luxury\Test\FuncTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app->make(\App\Http\Kernel::class);
    }
}