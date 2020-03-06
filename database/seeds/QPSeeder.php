<?php

use Illuminate\Database\Seeder;

class QPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vals = json_decode('[{"id":1,"question":"Retrieve the name and average point of each hero.","output":"[{\"name\":\"Black Canary\",\"avg_points\":\"92.0000\"},{\"name\":\"Green Arrow\",\"avg_points\":\"90.0000\"},{\"name\":\"The Flash\",\"avg_points\":\"66.0000\"},{\"name\":\"Wonder Woman\",\"avg_points\":\"99.0000\"}]","difficulty":5,"query":"select name, avg(hero_points) as avg_points from hero_management_battles inner join hero_management_heroes on hero_management_heroes.hero_id = hero_management_battles.hero_id group by name;","points":500,"deductible":null,"time":null,"data_pool_id":3,"is_quiz_query":1,"created_at":"2020-03-06 19:04:40","updated_at":"2020-03-06 19:04:40"},{"id":2,"question":"Retrieve the name of heroes and villains, date and location of battle where the heroes have scored lower than the villains.","output":"[{\"hero_name\":\"The Flash\",\"villian_name\":\"Ares\",\"date\":\"2016-09-10\",\"battle_location\":\"Metropolis\"},{\"hero_name\":\"Green Arrow\",\"villian_name\":\"Deathstroke\",\"date\":\"2018-11-06\",\"battle_location\":\"Star City\"}]","difficulty":7,"query":"select h.name as hero_name, v.name as villian_name, date, battle_location from hero_management_battles inner join hero_management_villains v on v.villain_id = hero_management_battles.villain_id inner join hero_management_heroes h on h.hero_id = hero_management_battles.hero_id where hero_points &lt; villain_points;","points":700,"deductible":null,"time":null,"data_pool_id":3,"is_quiz_query":1,"created_at":"2020-03-06 19:14:23","updated_at":"2020-03-06 19:14:23"},{"id":3,"question":"Retrieve the name of the villains who have fought the same hero more than once.","output":"[{\"name\":\"Deathstroke\"}]","difficulty":10,"query":"select name from hero_management_villains where villain_id in (select villain_id from hero_management_battles group by hero_id, villain_id having count(*) &gt; 1);","points":1000,"deductible":null,"time":null,"data_pool_id":3,"is_quiz_query":1,"created_at":"2020-03-06 19:51:55","updated_at":"2020-03-06 19:51:55"},{"id":4,"question":"Retrieve the name of villains whose location are not the same as their battle location.","output":"[{\"name\":\"Harley Quinn\"},{\"name\":\"Ares\"}]","difficulty":3,"query":"select name from hero_management_villains v where exists (select * from hero_management_battles b where b.battle_location != v.location and b.villain_id = v.villain_id);","points":300,"deductible":null,"time":null,"data_pool_id":3,"is_quiz_query":1,"created_at":"2020-03-06 19:56:14","updated_at":"2020-03-06 19:56:14"}]', true);

        foreach ($vals as $val) {
            App\QueryPool::create($val);
        }
    }
}
