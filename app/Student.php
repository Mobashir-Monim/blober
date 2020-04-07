<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use Carbon\Carbon;

class Student extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function analytics()
    {
        return [
            'Queries Attempted' => $this->queriesAttempted(),
            'Distinct Queries Attempted' => $this->distinctQueries(),
            'Success Rate' => $this->successRate() * 100 . '%',
            'Total Points' => $this->points,
            'Average Trials to Success' => $this->trialsToSuccess(),
            'Average Time to Success' => $this->avgTime(),
            'Average Error per Query' => $this->avgError(),
        ];
    }

    public function queriesAttempted()
    {
        $user = $this->user->id;

        return sizeof(\DB::select("select attempt_group_id from query_attempts where user_id = $user group by attempt_group_id;"));
    }

    public function distinctQueries()
    {
        $user = $this->user->id;

        return sizeof(\DB::select("select query_pool_id from query_attempts where user_id = $user group by query_pool_id;"));
    }

    public function successRate()
    {
        $user = $this->user->id;
        $div = $this->queriesAttempted();

        return $div == 0 ? 0 : number_format(sizeof(\DB::select("select attempt_group_id from query_attempts where user_id = $user and is_correct = true group by attempt_group_id;")) / $this->queriesAttempted(), 4, '.', '');
    }

    public function trialsToSuccess()
    {
        $user = $this->user->id;
        $trials = 0;
        $groups = AG::whereIn('id', array_column(json_decode(json_encode(\DB::select("select attempt_group_id from query_attempts where user_id = $user and is_correct = true group by attempt_group_id;")), true), 'attempt_group_id'))->get();

        foreach ($groups as $group) {
            $trials += count($group->attempts);
        }

        return count($groups) == 0 ? 'NULL' : number_format($trials / count($groups), 2, '.', '');
    }

    public function avgTime()
    {
        $user = $this->user->id;
        $groups = AG::whereIn('id', array_column(json_decode(json_encode(\DB::select("select attempt_group_id from query_attempts where user_id = $user and is_correct = true group by attempt_group_id;")), true), 'attempt_group_id'))->get();
        $time = 0;

        foreach ($groups as $group) {
            $time = Carbon::parse($group->created_at)->diffInSeconds(Carbon::parse($group->endtime));
        }
        
        return count($groups) == 0 ? "NULL" : floor($time / (count($groups) * 60)) . ':' .
                (($time / (count($groups))) % 60 < 10 ? 0 . ($time / (count($groups))) % 60 : ($time / (count($groups))) % 60);
    }

    public function avgError()
    {
        $user = $this->user->id;
        $groups = AG::whereIn('id', array_column(json_decode(json_encode(\DB::select("select attempt_group_id from query_attempts where user_id = $user and is_correct = true group by attempt_group_id;")), true), 'attempt_group_id'))->get();
        $errors = 0;

        foreach ($groups as $group) {
            $errors += count($group->attempts->where('has_error', true));
        }

        return count($groups) == 0 ? 'NULL' : number_format($errors / count($groups), 2, '.', '');
    }

    public function generateGraphAnalytics()
    {
        $data = ['dates' => $this->generateDatessArray(), 'points' => [0,0,0,0,0,0,0], 'errors' => [0,0,0,0,0,0,0], 'trials' => [0,0,0,0,0,0,0], 'queries' => [0,0,0,0,0,0,0]];

        foreach ($data['dates'] as $key => $date) {
            $attempts = QA::where('user_id', $this->user_id)->where('created_at', '>=', Carbon::parse($date . ' 00:00:00'))->where('created_at', '<=', Carbon::parse($date . ' 23:59:59'))->get();
            $data['trials'][$key] = count($attempts);
            $data['queries'][$key] = sizeof(array_unique($attempts->pluck('query_pool_id')->toArray()));
            
            foreach ($attempts as $set) {
                if ($set->is_correct == true) {
                    $data['points'][$key] += $set->pool->points;
                } else {
                    $data['points'][$key] -= $set->pool->deductible;

                    if ($set->has_error) {
                        $data['errors'][$key] += 1;
                    }
                }
            }
        }

        return $data;
    }

    public function generateDatessArray()
    {
        $now = Carbon::now();
        $dates = array();

        for ($i = 0; $i <= 6; $i++){
            array_push($dates, $now->copy()->addDays(-1 * $i)->toDateString());
        }

        return $dates;
    }
}
