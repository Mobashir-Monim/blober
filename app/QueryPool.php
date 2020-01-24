<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryPool extends Model
{
    public function tables()
    {
        return $this->belongsToMany('App\Tables');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
