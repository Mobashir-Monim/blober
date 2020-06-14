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
            ['name' => 'Lab Coordinator', 'email' => 'lc@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],
        ];

        foreach ($users as $key => $user) {
            App\User::create($user);

            DB::table('role_user')->insert(['user_id' => $key + 1,'role_id' => $key + 1,]);
        }

        // DB::table('role_user')->insert(['user_id' => 2,'role_id' => 6,]);
        // $count = 2 * rand(3, 6);

        // for ($i = 1; $i <= $count; $i++) {
        //     $user = App\User::create(['name' => 'Instructor '.$i, 'email' => 'li'.$i.'@blober.org', 'password' => bcrypt('bangladesh'), 'email_verified_at' => Carbon::now()->toDateTimeString()],);
            
        //     DB::table('role_user')->insert(['user_id' => $user->id,'role_id' => 5,]);
        // }
    }
}
