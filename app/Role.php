<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
