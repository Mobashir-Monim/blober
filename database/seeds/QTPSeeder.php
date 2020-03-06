<?php

use Illuminate\Database\Seeder;

class QTPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vals = json_decode('[{"id":1,"tag_id":1,"query_pool_id":1,"created_at":null,"updated_at":null},{"id":2,"tag_id":9,"query_pool_id":1,"created_at":null,"updated_at":null},{"id":3,"tag_id":7,"query_pool_id":1,"created_at":null,"updated_at":null},{"id":4,"tag_id":3,"query_pool_id":1,"created_at":null,"updated_at":null},{"id":5,"tag_id":1,"query_pool_id":2,"created_at":null,"updated_at":null},{"id":6,"tag_id":9,"query_pool_id":2,"created_at":null,"updated_at":null},{"id":7,"tag_id":5,"query_pool_id":2,"created_at":null,"updated_at":null},{"id":8,"tag_id":12,"query_pool_id":2,"created_at":null,"updated_at":null},{"id":9,"tag_id":1,"query_pool_id":3,"created_at":null,"updated_at":null},{"id":10,"tag_id":2,"query_pool_id":3,"created_at":null,"updated_at":null},{"id":11,"tag_id":3,"query_pool_id":3,"created_at":null,"updated_at":null},{"id":12,"tag_id":7,"query_pool_id":3,"created_at":null,"updated_at":null},{"id":13,"tag_id":1,"query_pool_id":4,"created_at":null,"updated_at":null},{"id":14,"tag_id":5,"query_pool_id":4,"created_at":null,"updated_at":null},{"id":15,"tag_id":12,"query_pool_id":4,"created_at":null,"updated_at":null}]', true);

        foreach ($vals as $val) {
            $statement = 'insert into tag_query_pool values (' . $val['id'] . ', ' . $val['tag_id'] . ', ' . $val['query_pool_id'] . ', ' . (is_null($val['created_at']) ? 'null' : $val['created_at'])  . ', ' . (is_null($val['updated_at']) ? 'null' : $val['updated_at']) . ');';
            \DB::statement($statement);
        }
    }
}
