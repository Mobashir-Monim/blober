<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSet extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
