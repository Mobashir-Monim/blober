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
}
