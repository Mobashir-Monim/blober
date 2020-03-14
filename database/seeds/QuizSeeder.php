<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = [
            "start" => Carbon::parse('6 am'),
            "end" => Carbon::parse('11:59 pm'),
            "section" => 1,
            "data" => '[{"diffTag":false,"allTags":{"1":"where in","3":"order by","4":"where","6":"group by","7":"distinct","8":"inner join","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","2":"aggregate","5":"having"},"diff":"1-3","qNo":"3","points":"10"},{"diffTag":false,"allTags":{"2":"aggregate","3":"order by","4":"where","5":"having","6":"group by","7":"distinct","8":"inner join","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","1":"where in"},"diff":"4-7","qNo":"3","points":"10"},{"diffTag":false,"allTags":{"1":"where in","2":"aggregate","3":"order by","4":"where","5":"having","6":"group by","7":"distinct","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","8":"inner join"},"diff":"8-10","qNo":"3","points":"10"}]',
        ];

        App\Quiz::create($quiz);
    }
}
