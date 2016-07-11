<?php

namespace App\Http\Controllers;

use App\Constants\Services;
use App\Facades\SomeApi;
use Luxury\Middleware\Wtf as WtfMiddleware;

/**
 * Class IndexController
 *
 * @package Controllers
 */
class IndexController extends ControllerBase
{
    protected function onConstruct()
    {
        parent::onConstruct();

        $this->middleware(new WtfMiddleware());
    }

    public function indexAction()
    {
        // Call SomeApi using DependencyInjection
        $this->{Services::SOME_API}->doSomething();

        // Call SomeApi using Facade
        SomeApi::doAnotherThing();

        $this->view->content = "Some Content";
    }

    public function forwardAction()
    {
        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index'
        ]);
    }
}

