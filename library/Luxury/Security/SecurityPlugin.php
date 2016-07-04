<?php

namespace Luxury\Security;

use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

/**
 * Class SecurityPlugin
 *
 * @package Luxury\Security
 */
class SecurityPlugin extends Plugin
{
    /**
     * TODO Refactorize & make it configurable
     *
     * Returns an existing or new access control list
     *
     * @returns AclList
     */
    public function getAcl()
    {
        if (! isset($this->persistent->acl)) {
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);
            // Register roles
            $roles = [
                'users'  => new Role(
                    'Users',
                    'Member privileges, granted after sign in.'
                ),
                'guests' => new Role(
                    'Guests',
                    'Anyone browsing the site who is not signed in is considered to be a "Guest".'
                )
            ];
            foreach ($roles as $role) {
                $acl->addRole($role);
            }
            //Private area resources
            $privateResources = [
                'companies'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'invoices'     => ['index', 'profile']
            ];
            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }
            //Public area resources
            $publicResources = [
                'index'    => ['index'],
                'about'    => ['index'],
                'register' => ['index'],
                'errors'   => ['show401', 'show404', 'show500'],
                'session'  => ['index', 'register', 'start', 'end'],
                'contact'  => ['index', 'send']
            ];
            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }
            //Grant access to public areas to both users and guests
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    foreach ($actions as $action) {
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }
            }
            //Grant access to private area to role Users
            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
                }
            }
            //The acl is stored in session, APC would be useful here too
            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    /**
     * This action is executed before execute any action in the application
     *
     * @param Event      $event
     * @param Dispatcher $dispatcher
     *
     * @return bool
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        if (! $auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();
        $acl        = $this->getAcl();
        if (! $acl->isResource($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show404'
            ]);

            return false;
        }
        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show401'
            ]);
            $this->session->destroy();

            return false;
        }

        return true;
    }
}