<?php

namespace App\Helpers;

use App\QueryPool as QP;
use App\QuizSet as QS;
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
        
        if ($this->hadQuiz) {
            $this->getQuestions(json_decode($this->quiz->data));
        } else {
            $this->retrieveSetData();
        }

        $this->selected->shuffle();
    }

    public function getQuestions($classes)
    {
        foreach ($classes as $key => $class) {
            $tags = Tag::whereIn('name', $this->objToArray($class->tags, true))->get();
            $this->addQueries($this->getCollective($tags, $this->diffRange($class->diff), $this->getRejects(), $class->qNo), $key);
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
        $ids = implode(', ', array_column(json_decode(json_encode(\DB::select('select query_pool_id from tag_query_pool group by query_pool_id having count(query_pool_id) = ' . count($tags) . ';')), true), 'query_pool_id'));
        $removeables = implode(', ', array_column(json_decode(json_encode(\DB::select("select * from tag_query_pool where query_pool_id in ($ids) and tag_id not in ($list);")), true), 'query_pool_id'));
        $ids = array_column(json_decode(json_encode(\DB::select("select * from tag_query_pool where query_pool_id in ($ids) and tag_id in ($list) and query_pool_id not in ($removeables)")), true), 'query_pool_id');

        if (sizeof($range) == 1) {
            $queries = QP::whereIn('id', $ids)->whereNotIn('id', $rejects)->where('diff', '<=', $range[0])->where('is_quiz_query', true)->get();
        } else {
            $queries = QP::whereIn('id', $ids)->whereNotIn('id', $rejects)->where('difficulty', '>=', $range[0])->where('difficulty', '<=', $range[1])->where('is_quiz_query', true)->get();
        }

        return $queries->shuffle()->take($num);
    }

    public function addQueries($queries, $key)
    {
        if (is_null($this->selected)) {
            $this->selected = $queries;
        } else {
            $this->selected = $this->selected->merge($queries);
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