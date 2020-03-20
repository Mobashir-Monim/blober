<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function usedTime()
    {
        return Carbon::parse($this->start)->diffInSeconds(Carbon::now());
    }
}
