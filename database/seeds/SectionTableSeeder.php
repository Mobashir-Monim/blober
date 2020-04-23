<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\Role::find(5)->users;
        $count = count($users);
        $now = new Carbon;
        $semester = ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year;
        
        for ($i = 1; $i <= $count + rand(0, $count); $i++) {
            $u = ($i - 1) % $count;
            $next = rand(0, $count - 1);
            $section = App\Section::create(['section' => $i, 'semester' => $semester]);

            while ($next == $u) {
                $next = rand(0, $count - 1);
            }

            $section->users()->attach($users[$u]->id);
            $section->users()->attach($users[$next]->id);
        }
    }
}
