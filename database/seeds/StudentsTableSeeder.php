<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('students')->insert([
            'user_id' => 5,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,
            'section' => 1,
        ]);

        DB::table('students')->insert([
            'user_id' => 2,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,
            'section' => 1,
        ]);
    }
}
