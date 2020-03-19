<?php

use Illuminate\Database\Seeder;

class QPTTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [rand(15, 30), rand(15, 30), rand(15, 30), rand(15, 30), rand(15, 30)];
        $base = 0;
        $id = 1;

        foreach ($arr as $key => $val) {
            for ($tag = 1; $tag <= $key + 1; $tag++) {
                for ($qp = $base + 1; $qp <= $base + $val; $qp++) {
                    \DB::select("insert into tag_query_pool values($id, $tag, $qp, NULL, NULL)");
                    $id++;
                }
            }

            $base += $val;
        }
    }
}
