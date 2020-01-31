<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function tables()
    {
        return $this->belongsToMany('App\DataPool');
    }
}
