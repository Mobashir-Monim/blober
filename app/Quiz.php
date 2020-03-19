<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends BaseModel
{
    public function attempts()
    {
        return $this->hasMany('App\QuizAttempt');
    }

    public function sets()
    {
        return $this->hasMany('App\QuizSet');
    }
}
