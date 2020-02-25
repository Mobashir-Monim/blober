<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttemptGroup extends BaseModel
{
    public function attempts()
    {
        return $this->hasMany('App\QueryAttempt');
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

    public function hasSuccess()
    {
        return in_array(true, $this->attempts->pluck('is_correct')->toArray());
    }

    public function trialsToSuccess()
    {
        $index = array_search(1, $this->attempts->pluck('is_correct')->toArray());

        return $index ? $index + 1 : count($this->attempts);
    }
}
