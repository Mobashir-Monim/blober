<?php

namespace App\Helpers;

use App\QueryPool as QP;

class QuizHelper extends Helper
{
    protected $selected = null;

    public function __construct()
    {
        $this->selected = QP::all()->shuffle()->take(rand(8, 26));
    }

    public function makeQuestions()
    {
        $questions = array();

        foreach ($this->selected as $question) {
            array_push($questions, ['question' => $question->question, 'points' => $question->points, 'output' => $question->output]);
        }

        return $questions;
    }

    public function getQids()
    {
        return $this->selected->pluck('id')->toArray();
    }

    public function getTables()
    {
        $helper = new QueryPoolHelper;
        $tables = array();

        foreach ($this->selected as $question) {
            array_push($tables, $helper->bringTables($question));
        }

        return $tables;
    }
}