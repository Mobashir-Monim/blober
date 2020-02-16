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
        for ($i = 0; $i < rand(5, 25); $i++) {
            App\Tag::create(['name' => "Tag-$i"]);
        }
    }
}
