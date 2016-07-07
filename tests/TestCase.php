<?php

use Phalcon\Di;

/**
 * Class UnitTestCase
 */
abstract class TestCase extends \Luxury\Test\FuncTestCase
{
    /**
     * @return mixed
     */
    protected function kernel()
    {
        return \App\Http\Kernel::class;
    }

    public function setUp()
    {
        parent::setUp();
    }
}