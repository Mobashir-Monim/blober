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
        $semester = ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year;
        // $sections = App\Section::where('semester', $semester)->get();

        // foreach ($sections as $section) {
        //     for ($i = 1; $i <= rand(35, 40); $i++) { 
        //         $user = App\User::create(['name' => "Student $section->id $i", 'email' => "s$section->id-$i@blober.org", 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],);
        //         DB::table('role_user')->insert(['user_id' => $user->id,'role_id' => 6]);
        //         DB::table('students')->insert(['user_id' => $user->id, 'level_name' => 'Beginner', 'level' => 0,'points' => 0, 'enrollment' => $semester, 'section' => $section->id, 'student_id' => $this->genId()]);
        //     }
        // }

        DB::table('students')->insert([
            'user_id' => 2,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => $semester,
            'section' => 1,
            'student_id' => $this->genId(),
        ]);
    }

    public function genId()
    {
        $years = [16, 17, 18, 19, 20];
        return $years[rand(0,4)] . rand(1,6) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
    }
}
