<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class Student extends Helper
{
    public $routes = [
        'home',
        'users.edit',
        'query.attempt',
        'quiz.panel',
        'quiz.start',
        'quiz.invalid',
    ];

    public $actions = [
        'query.attempt',
    ];
}