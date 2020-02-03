<?php

use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= rand(20, 40); $i++) {
            App\Table::create(["name" => "Table - $i"]);
        }
    }
}
