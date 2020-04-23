<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class SuperAdmin extends Helper
{
    public $routes = [
        'home',
        'home.user',
        'users.index',
        'users.create',
        'users.edit',
        'datapool.index',
        'datapool.create',
        'query.index',
        'query.create',
        'tags.index',
        'analytics.tags',
        'quiz.index',
        'quiz.create',
        'quiz.edit',
        'quiz.score.export',
        'sections.index',
        'sections.create',
        'students.add'
    ];

    public $actions = [
        'users.create',
        'users.edit',
        'datapool.create',
        'query.create',
        'quiz.create',
        'quiz.edit',
        'sections.create',
        'students.add'
    ];
}