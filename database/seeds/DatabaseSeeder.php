w<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            RoleUserTableSeeder::class,
            StudentsTableSeeder::class,
            TagsTableSeeder::class,
            DPSeeder::class,
            QPSeeder::class,
            QTPSeeder::class,
            // TableSeeder::class,
            // PoolTableSeeder::class,
        ]);
    }
}
