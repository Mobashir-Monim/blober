<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function pools()
    {
        return $this->belongsToMany('App\QueryPool');
    }
}
