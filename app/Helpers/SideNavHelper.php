<?php

namespace App\Helpers;

use App\User;

class SideNavHelper extends Helper
{
    public $items = [];

    public function __construct(User $user)
    {
        array_push($this->items, ['route' => route('home'), 'name' => 'Dashboard', 'width' => 'w-100']);
        $func = str_replace('-', '_', $user->highestRole()->name); 
        $this->$func();

        return $this->items;
    }

    public function super_admin()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.create'), 'name' => 'Add Query', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => 'w-100']);
    }

    public function developer()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.create'), 'name' => 'Add Query', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('query.attempt'), 'name' => 'Practice', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('quiz.panel'), 'name' => 'Attempt Quiz', 'width' => 'w-75']);
    }

    public function admin()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => 'w-100']);
    }

    public function senior_faculty()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.create'), 'name' => 'Add Query', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => 'w-100']);
    }

    public function junior_faculty()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('query.create'), 'name' => 'Add Query', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => 'w-75']);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => 'w-100']);
    }

    public function student()
    {
        array_push($this->items, ['route' => route('query.attempt'), 'name' => 'Practice', 'width' => 'w-100']);
        array_push($this->items, ['route' => route('quiz.panel'), 'name' => 'Attempt Quiz', 'width' => 'w-100']);
    }
}