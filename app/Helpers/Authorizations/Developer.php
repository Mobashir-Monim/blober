<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class Developer extends Helper
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
        'query.attempt',
        'tags.index',
        'analytics.tags',
        'quiz.index',
        'quiz.create',
        'quiz.edit',
        'quiz.panel',
        'quiz.start',
        'quiz.invalid',
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
        'query.attempt',
        'quiz.create',
        'quiz.edit',
        'sections.create',
        'students.add'
    ];
}