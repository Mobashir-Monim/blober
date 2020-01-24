<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Super Admin', 'level' => 5],
            ['name' => 'developer', 'display_name' => 'System Developer', 'level' => 6],
            ['name' => 'admin', 'display_name' => 'Admin', 'level' => 4],
            ['name' => 'senior-faculty', 'display_name' => 'Senior Faculty', 'level' => 3],
            ['name' => 'junior-faculty', 'display_name' => 'Junior Faculty', 'level' => 2],
            ['name' => 'student', 'display_name' => 'Student', 'level' => 1],
        ];

        foreach ($roles as $role) {
            App\Role::create($role);
        }
    }
}
