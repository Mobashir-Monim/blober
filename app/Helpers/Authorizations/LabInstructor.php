<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class LabInstructor extends Helper
{
    public $routes = [
        'home',
        'home.user',
        'users.index',
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
        'datapool.edit',
        'query.edit',

    ];

    public $actions = [
        'datapool.create',
        'query.create',
        'quiz.create',
        'quiz.edit',
        'sections.create',
        'students.add',
        'datapool.edit',
        'query.edit'
    ];
}