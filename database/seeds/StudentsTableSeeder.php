<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'user_id' => 6,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
        ]);
    }
}
