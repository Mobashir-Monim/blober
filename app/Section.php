<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends BaseModel
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
