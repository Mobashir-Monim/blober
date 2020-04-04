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
            'user_id' => 6,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,
            'section' => 1,
            'student_id' => rand(10000000, 99999999),
        ]);

        DB::table('students')->insert([
            'user_id' => 2,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,
            'section' => 1,
            'student_id' => rand(10000000, 99999999),
        ]);
    }
}
