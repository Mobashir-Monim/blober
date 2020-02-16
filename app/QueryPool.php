<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryPool extends BaseModel
{
    public function datapool()
    {
        return $this->belongsTo('App\DataPool', 'data_pool_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_query_pool');
    }
}
