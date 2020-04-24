<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryPool extends BaseModel
{
    public function datapool()
    {
        return $this->belongsTo('App\DataPool', 'data_pool_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_query_pool');
    }

    public function attempts()
    {
        return $this->hasMany('App\QueryAttempt', 'query_pool_id');
    }

    public function quizGroup()
    {
        return $this->hasMany('App\QuizAttemptGroup');
    }

    public function quizAttempt()
    {
        return $this->hasMany('App\QuizAttempt');
    }

    public function viewableData()
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'query' => is_null($this->query) ? $this->output : $this->query,
            'points' => $this->points,
            'deductible' => $this->deductible,
            'time' => $this->time,
            'is_quiz_query' => $this->is_quiz_query,
            'tags' => $this->tags->pluck('name', 'id')->toArray()
        ];
    }
}
