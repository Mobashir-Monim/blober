<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
    public function pools()
    {
        return $this->belongsToMany('App\QueryPool');
    }
}
