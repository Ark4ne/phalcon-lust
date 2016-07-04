<?php

namespace App\Http\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * Class ControllerJson
 *
 * @package     App\Http\Controllers
 */
class ControllerJson extends Controller
{
    public function initialize()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }
}