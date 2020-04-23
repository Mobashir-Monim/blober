<?php

namespace App\Helpers\Authorizations;

use App\Helpers\Helper;

class LabCoordinator extends Helper
{
    public $routes = [
        'home',
        'home.user',
        'users.index',
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
    ];

    public $actions = [
        'datapool.create',
        'query.create',
        'quiz.create',
        'quiz.edit',
        'datapool.edit',
    ];
}