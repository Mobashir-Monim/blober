<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPool extends BaseModel
{
    /**
     * Relationship functions
    */

    public function tables()
    {
        return $this->belongsToMany('App\Table');
    }

    public function queries()
    {
        return $this->hasMany('App\QueryPool');
    }

    /**
     * Validation functions
    */


    /**
     * Custom functions
    */

    public function getViewableQueries()
    {
        $queries = array();

        foreach ($this->queries as $key => $query) {
            array_push($queries, $query->viewableData());
        }

        return $queries;
    }
}
