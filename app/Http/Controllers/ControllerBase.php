<?php

namespace App\Http\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * Class ControllerBase
 *
 * @package Controllers
 */
class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }
}
