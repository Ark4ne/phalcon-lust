<?php

namespace App\Http\Controllers;

use Luxury\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package     App\Http\Controllers
 */
class AuthController extends ControllerBase
{

    public function signinAction()
    {
    }

    public function loginAction()
    {
        // Get the data from the user
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = Auth::attempt([
            'email'    => $email,
            'password' => $password,
        ]);

        if (is_null($user)) {
            $this->flash->error('Wrong email/password');

            // Forward to the login form again
            return $this->dispatcher->forward([
                'controller' => 'auth',
                'action'     => 'signin'
            ]);
        }

        $this->flash->success('Welcome ' . $user->name);

        // Forward to the 'invoices' controller if the user is valid
        return $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index'
        ]);
    }
}