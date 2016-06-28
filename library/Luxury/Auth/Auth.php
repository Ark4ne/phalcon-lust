<?php

namespace Luxury\Auth;

use App\Models\User;
use Phalcon\Di\Injectable as Injector;

/**
 * Class Auth
 *
 * @package Luxury\Auth
 *
 * @property \Phalcon\Config|\stdClass config
 */
class Auth extends Injector
{

    protected $user;

    /**
     * Indicates if the logout method has been called.
     *
     * @var bool
     */
    protected $loggedOut = false;

    /**
     * Auth::user() will check the session to see if user is alive on the session if so grabs user id and retrieves user info from the database
     * If session is not set null is returned.
     *
     * @parametre  değişklen açıklamaları
     *
     * @return User object else null
     */
    public function user()
    {
        if ($this->loggedOut) {
            return null;
        }

        if (! is_null($this->user)) {
            return $this->user;
        }

        if ($this->session->has($this->sessionKey())) {
            $id = $this->session->get($this->sessionKey());
        } else {
            $id = null;
        }

        if (! is_null($id)) {
            $this->user = $user = $this->retrieveById($id);
        }

        return $this->user;

    }

    /**
     * If user is NOT logged into the system return true else false;
     *
     * @return bool Guest is true, Loggedin is false
     */
    public function guest()
    {
        return ! $this->check();
    }


    /**
     * authenticate user
     *
     * @param  array $credentials
     *
     * @return void
     */
    public function attempt(array $credentials = [])
    {
        // TODO
    }

    /**
     * Determine if user is authenticated
     *
     * @return bool
     */
    public function check()
    {
        return ! is_null($this->user());
    }

    /**
     * Log out of the application
     */
    public function logout()
    {
        $this->user      = null;
        $this->loggedOut = true;

        $this->session->destroy();
    }

    /**
     * Get currently logged user's id
     *
     * @return mixed|null
     */
    public function id()
    {
        if ($this->session->has($this->sessionKey())) {
            return $this->session->get($this->sessionKey());
        } else {
            return null;
        }
    }

    /**
     * Log a user into the application
     *
     * @param $user
     *
     * @return bool
     */
    private function login($user)
    {
        if (! $user)
            return false;

        $this->regenerateSessionId();

        $this->session->set($this->sessionKey(), $user->id);

        return true;
    }

    /**
     * Log a user into the application using id
     *
     * @param int $id
     *
     * @return User
     */
    public function loginUsingId($id)
    {
        $this->login($user = $this->retrieveById($id));

        return $user;
    }

    /**
     * Retrieve session id
     *
     * @return mixed
     */
    private function sessionKey()
    {
        return $this->config->session->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function retrieveById($id)
    {
        // TODO
    }

    /**
     * Regenerate Session ID
     */
    protected function regenerateSessionId()
    {
        session_regenerate_id(true);
    }
}