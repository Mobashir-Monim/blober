<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class Admin extends Helper
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
        'tags.index',
        'analytics.tags',
        'quiz.index',
        'quiz.create',
        'quiz.edit',
        'quiz.score.export',
        'sections.index',
        'sections.create',
        'students.add',
        'datapool.edit'
    ];

    public $actions = [
        'users.create',
        'users.edit',
        'datapool.create',
        'quiz.create',
        'quiz.edit',
        'sections.create',
        'students.add',
        'datapool.edit'
    ];
}