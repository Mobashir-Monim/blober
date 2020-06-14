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
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            // SectionTableSeeder::class,
            // StudentsTableSeeder::class,
            TagsTableSeeder::class,
            DPSeeder::class,
            QPSeeder::class,
            QTPSeeder::class,
            QuizSeeder::class,
            // PoolTableSeeder::class,
        ]);
    }
}
