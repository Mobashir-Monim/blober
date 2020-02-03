<?php

use Illuminate\Database\Seeder;

class DataPoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= rand(7, 15); $i++) {
            App\DataPool::create(["name" => "DP - $i"]);
        }
    }
}
