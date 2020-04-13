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
        $sections = App\Section::select('section_id')->groupBy('section_id')->get()->pluck('section_id')->toArray();

        foreach ($sections as $section) {
            for ($i = 1; $i <= rand(35, 40); $i++) { 
                $user = App\User::create(['name' => "Student $section $i", 'email' => "s$section-$i@blober.org", 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],);
                DB::table('role_user')->insert(['user_id' => $user->id,'role_id' => 6,]);
                DB::table('students')->insert(['user_id' => $user->id,'level_name' => 'Beginner','level' => 0,'points' => 0,'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,'section' => $section,'student_id' => rand(10000000, 99999999),]);
            }
        }

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
