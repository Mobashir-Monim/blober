<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttemptGroup extends BaseModel
{
    public function question()
    {
        return $this->belongsTo('App\QueryPool');
    }

    public function attempts()
    {
        return $this->hasMany('App\QuizAttempt');
    }
}
