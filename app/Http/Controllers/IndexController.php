<?php

namespace App\Http\Controllers;

use App\Constants\Services;
use App\Facades\SomeApi;

/**
 * Class IndexController
 *
 * @package Controllers
 */
class IndexController extends ControllerBase
{
    public function indexAction()
    {
        // Call SomeApi using DependencyInjection
        $this->getDI()->get(Services::SOME_API)->doSomething();

        // Call SomeApi using Facade
        SomeApi::doAnotherThing();

        $this->view->content = "Some Content";
    }
}

