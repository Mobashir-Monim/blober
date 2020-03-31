<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends BaseModel
{
    public function group()
    {
        return $this->belongsTo('App\QuizAttemptGroup', 'quiz_attempt_group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function question()
    {
        return $this->belongsTo('App\QueryPool');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
