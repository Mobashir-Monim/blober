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
            "start" => Carbon::parse('12:01 am'),
            "end" => Carbon::parse('11:59 pm'),
            "section" => 1,
            "data" => '[{"diffTag":false,"allTags":{"1":"where in","2":"aggregate","3":"order by","5":"having","6":"group by","7":"distinct","8":"inner join","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","4":"where"},"diff":"1-3","qNo":"3","points":""},{"diffTag":false,"allTags":{"1":"where in","2":"aggregate","5":"having","6":"group by","7":"distinct","8":"inner join","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","3":"order by","4":"where"},"diff":"1-5","qNo":"1","points":null},{"diffTag":false,"allTags":{"1":"where in","2":"aggregate","3":"order by","5":"having","6":"group by","7":"distinct","8":"inner join","9":"left join","10":"right join","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","4":"where","11":"nested"},"diff":"1-5","qNo":"1","points":""},{"diffTag":false,"allTags":{"1":"where in","2":"aggregate","3":"order by","5":"having","6":"group by","7":"distinct","9":"left join","10":"right join","11":"nested","12":"insert","13":"drop","14":"alter","15":"describe/show"},"tags":{"0":"select","4":"where","8":"inner join"},"diff":"1-5","qNo":"1","points":""}]',
            "created_by" => 2,
        ];

        App\Quiz::create($quiz);
    }
}
