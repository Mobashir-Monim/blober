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

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function questionCount()
    {
        $data = json_decode($this->data, true);
        $returnee = 0;

        foreach ($data as $group) {
            $returnee += $group['qNo'];
        }

        return $returnee;
    }

    public function groupCount()
    {
        $data = json_decode($this->data, true);

        return sizeof($data);
    }

    public function duration()
    {
        return Carbon::parse($this->start)->diffInSeconds(Carbon::parse($this->end));
    }

    public function remainingTime()
    {
        $set = $this->sets->where('user_id', auth()->user()->id)->first();
        
        if (is_null($set)) {
            return $this->duration();
        } else {
            return $this->duration() - $set->usedTime();
        }
    }
}
