<?php

namespace App\Helpers;

use App\QueryPool as QP;
use App\Quiz;
use App\Tag;
use Carbon\Carbon;

class QuizHelper extends Helper
{
    public $selected = null;
    protected $quiz = null;

    public function __construct()
    {
        $now = Carbon::now();
        $this->quiz = Quiz::where('section', auth()->user()->student->section)->where('start', '<=', $now)->where('end', '>', $now)->first();
        $this->getQuestions(json_decode($this->quiz->data));
    }

    public function getQuestions($classes)
    {
        foreach ($classes as $class) {
            $tags = Tag::whereIn('name', $this->objToArray($class->tags, true))->get();
            $this->addQueries($this->getCollective($tags, $this->diffRange($class->diff), $this->getRejects(), $class->qNo));
        }
    }

    public function diffRange($range)
    {
        $range = explode('-', $range);

        foreach ($range as $key => $val) {
            $range[$key] = trim($val);
        }

        return $range;
    }

    public function getRejects()
    {
        $rejects = [];

        if (!is_null($this->selected)) {
            $rejects = $this->selected->pluck('id')->toArray();
        }

        return $rejects;
    }

    public function getCollective($tags, $range, $rejects, $num)
    {
        $queries = null;
        $list = $this->objToString($tags->pluck('id'), false);
        $ids = array_column($this->objToArray(\DB::select("select query_pool_id from tag_query_pool where tag_id in ($list) group by query_pool_id having count(*) = " . count($tags) . " order by query_pool_id;"), false), 'query_pool_id');

        if (sizeof($range) == 1) {
            $queries = QP::whereIn('id', $ids)->whereNotIn('id', $rejects)->where('diff', '<=', $range[0])->where('is_quiz_query', true)->get();
        } else {
            $queries = QP::whereIn('id', $ids)->whereNotIn('id', $rejects)->where('difficulty', '>=', $range[0])->where('difficulty', '<=', $range[1])->where('is_quiz_query', true)->get();
        }

        return $queries->take($num);
    }

    public function addQueries($queries)
    {
        if (is_null($this->selected)) {
            $this->selected = $queries;
        } else {
            $this->selected->merge($queries);
        }
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

    public function getTime()
    {
        return Carbon::parse($this->quiz->start)->diffInSeconds(Carbon::parse($this->quiz->end));
    }
}