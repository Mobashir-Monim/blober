<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryAttempt extends BaseModel
{
    public function group()
    {
        return $this->belongsTo('App\AttemptGroup', 'attempt_group_id');
    }
}
