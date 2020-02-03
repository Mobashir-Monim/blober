<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pools = App\DataPool::all()->toArray();
        $tables = App\Table::all()->toArray();
        $now = Carbon::now()->toDateTimeString();

        for ($i = 0; $i <= rand(ceil(sizeof($pools) * sizeof($tables) / rand(3, 5)), ceil(sizeof($pools) * sizeof($tables) / rand(1, 2)));) {
            $table_id = $tables[rand(0, sizeof($tables) - 1)]["id"];
            $pool_id = $pools[rand(0, sizeof($pools) - 1)]["id"];


            if (sizeof(\DB::select("select * from data_pool_table where table_id = $table_id and data_pool_id = $pool_id")) == 0) {
                DB::table('data_pool_table')->insert([
                    ['data_pool_id' => $pool_id, 'table_id' => $table_id, 'created_at' => $now, 'updated_at' => $now],
                ]);
                $i++;
            } 
        }
    }
}
