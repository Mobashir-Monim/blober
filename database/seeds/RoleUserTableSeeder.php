<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < count(App\User::all()); $i++) {
            DB::table('role_user')->insert([
                'user_id' => $i,
                'role_id' => $i,
            ]);
        }
    }
}
