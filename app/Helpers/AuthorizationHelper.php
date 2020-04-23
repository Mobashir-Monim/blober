<?php

namespace App\Helpers;

use App\Helpers\Authorizations\Developer;
use App\Helpers\Authorizations\SuperAdmin;
use App\Helpers\Authorizations\Admin;
use App\Helpers\Authorizations\LabCoordinator;
use App\Helpers\Authorizations\LabInstructor;
use App\Helpers\Authorizations\Student;

class AuthorizationHelper extends Helper
{
    protected $auth;

    public function __construct()
    {
        $role = auth()->user()->highestRole();

        if ($role->name == 'developer') {
            $this->auth = new Developer;
        } elseif ($role->name == 'super-admin') {
            $this->auth = new SuperAdmin;
        } elseif ($role->name == 'admin') {
            $this->auth = new Admin;
        } elseif ($role->name == 'lab-coordinator') {
            $this->auth = new LabCoordinator;
        } elseif ($role->name == 'lab-instructor') {
            $this->auth = new LabCoordinator;
        } else {
            $this->auth = new Student;
        }
    }

    public function isAuthorized($route = null, $method = null)
    {
        if (is_null($route))
            $route = request()->route()->getName();

        if (is_null($method))
            $method = request()->method();

        if ($method == 'GET') {
            return in_array($route, $this->auth->routes);
        } else {
            return in_array($route, $this->auth->actions);
        }
    }
}