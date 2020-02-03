<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends BaseModel
{
    /**
     * Relationship functions
    */
    public function tables()
    {
        return $this->belongsToMany('App\DataPool');
    }


    /**
     * Validation functions
    */


    /**
     * Custom functions
    */

    public static function createMultipleTables($inputs)
    {
        $tables = array();

        foreach ($inputs as $input) {
            $table = self::create(['name' => $input]);
            array_push($tables, $table);
        }

        return $tables;
    }
}
