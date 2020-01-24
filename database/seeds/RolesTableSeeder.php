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
            ['name' => 'super_admin', 'display_name' => 'Super Admin'],
            ['name' => 'developer', 'display_name' => 'System Developer'],
            ['name' => 'admin', 'display_name' => 'Admin'],
            ['name' => 'senior_faculty', 'display_name' => 'Senior Faculty'],
            ['name' => 'junior_faculty', 'display_name' => 'Junior Faculty'],
            ['name' => 'student', 'display_name' => 'Student'],
        ];

        foreach ($roles as $role) {
            App\Role::create($role);
        }
    }
}
