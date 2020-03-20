<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function remainingTime()
    {
        $set = $this->sets->where('user_id', auth()->user()->id)->first();
        
        if (is_null($set)) {
            return Carbon::parse($this->start)->diffInSeconds(Carbon::parse($this->end));
        } else {
            return Carbon::parse($this->start)->diffInSeconds(Carbon::parse($this->end)) - $set->usedTime();
        }
    }
}
