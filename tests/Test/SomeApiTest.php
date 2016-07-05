<?php

namespace Test;

use App\Facades\SomeApi;

class SomeApiTest extends \TestCase
{
    public function testSomeapiFunction()
    {
        SomeApi::shouldReceive('doSomething')->andReturnNull();

        $this->assertNull(SomeApi::doSomething());
    }
    
    public function testSomeapiOtherFunction()
    {
        SomeApi::shouldReceive('doAnotherThing')->andReturn(true);

        $this->assertTrue(SomeApi::doAnotherThing());
    }
}