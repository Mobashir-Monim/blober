<?php

namespace App\Helpers;

use App\User;

class SideNavHelper extends Helper
{
    public $items = [];
    public $widths = ["w-100", "w-75"];
    public $floats = ['', 'text-right'];

    public function __construct(User $user)
    {
        array_push($this->items, ['route' => route('home'), 'name' => 'Dashboard', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        $func = str_replace('-', '_', $user->highestRole()->name); 
        $this->$func();

        return $this->items;
    }

    public function super_admin()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('sections.index'), 'name' => 'Sections', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }

    public function developer()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.attempt'), 'name' => 'Practice', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.panel'), 'name' => 'Attempt Quiz', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('sections.index'), 'name' => 'Sections', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }

    public function admin()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('sections.index'), 'name' => 'Sections', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }

    public function lab_coordinator()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('sections.index'), 'name' => 'Sections', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }

    public function lab_instructor()
    {
        array_push($this->items, ['route' => route('users.index'), 'name' => 'Users', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('datapool.index'), 'name' => 'Datapools', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('query.index'), 'name' => 'Queries', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('tags.index'), 'name' => 'Tags', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('analytics.tags'), 'name' => 'Tag Analytics', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.index'), 'name' => 'Quizzes', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }

    public function student()
    {
        array_push($this->items, ['route' => route('query.attempt'), 'name' => 'Practice', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
        array_push($this->items, ['route' => route('quiz.panel'), 'name' => 'Attempt Quiz', 'width' => $this->widths[rand(0,1)], 'alignment' => $this->floats[rand(0, 1)]]);
    }
}