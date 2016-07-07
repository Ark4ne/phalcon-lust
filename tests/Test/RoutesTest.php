<?php

namespace Test;

use Luxury\Test\RoutesTestCase;

/**
 * Class RoutesTest
 */
class RoutesTest extends RoutesTestCase
{
    use \TraitTestCase;

    /**
     * @return array
     */
    protected function routes()
    {
        return [
            ['', 'GET', true, 'index', 'index'],
        ];
    }
}