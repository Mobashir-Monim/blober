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

    public function flag()
    {
        if (is_null($this->endtime)) {
            $now = Carbon::now();
            $duration = $this->quiz->duration();
            $end = Carbon::parse($this->created_at)->addSeconds($duration);

            if ($end < $now) {
                $this->endtime = $end->toDateTimeString();
            } else {
                $this->endtime = $now->toDateTimeString();
            }

            $this->save();
        }
    }
}
