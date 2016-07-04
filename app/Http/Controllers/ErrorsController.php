<?php

namespace App\Http\Controllers;
use Phalcon\Error\Handler;


/**
 * Class ErrorsController
 *
 * @package App\Http\Controllers
 */
class ErrorsController extends ControllerBase
{
    public function indexAction()
    {
        /**
         * @var \Phalcon\Error\Error $error
         */
        $error = $this->dispatcher->getParam('error');

        $this->view->error = [
            'type'    => Handler::getErrorType($error->type),
            'message' => $error->message,
            'file'    => $error->file,
            'line'    => $error->line,
        ];
    }

    public function http404Action()
    {

    }
}