<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Super Admin', 'email' => 'sa@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Developer', 'email' => 'dev@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Admin', 'email' => 'admin@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Senior Faculty', 'email' => 'sfaculty@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Junior Faculty', 'email' => 'jfaculty@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
            ['name' => 'Student', 'email' => 'student@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
        ];

        foreach ($users as $user) {
            App\User::create($user);
        }
    }
}
