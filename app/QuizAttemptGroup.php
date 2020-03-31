<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function flaggable()
    {
        return is_null($this->endtime);
    }

    public function flag()
    {
        $this->endtime = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
