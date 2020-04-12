<?php

use Illuminate\Database\Seeder;

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
        
        for ($i = 1; $i <= $count + rand(0, $count); $i++) {
            $u = ($i - 1) % $count;
            $next = rand(0, $count - 1);

            while ($next == $u) {
                $next = rand(0, $count - 1);
            }

            App\Section::create(['section_id' => $i, 'user_id' => $users[$u]->id]);
            App\Section::create(['section_id' => $i, 'user_id' => $users[$next]->id]);
        }
    }
}
