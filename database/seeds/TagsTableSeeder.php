<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
                    'select', 'where in', 'aggregate', 'order by', 'where', 'having', 'group by', 'distinct',
                    'inner join', 'left join', 'right join', 'nested', 'insert', 'drop', 'alter', 'describe/show'
                ];

        foreach ($tags as $tag) {
            App\Tag::create(['name' => "$tag"]);
        }
    }
}
