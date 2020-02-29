<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Tag;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use App\QueryPool as QP;

class AnalyticsHelper extends Helper
{
    public function getUserAttemptsCount($tag)
    {
        return sizeof($this->getUserAttempts($tag)) . '';
    }

    public function getUserAttempts($tag)
    {
        return \DB::select("select attempt_group_id from query_attempts where query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id) group by attempt_group_id");
    }

    public function getAttemptGroupsCount($tag)
    {
        return sizeof($this->getAttemptGroups($tag)) . '';
    }

    public function getAttemptGroups($tag)
    {
        return \DB::select("select user_id from query_attempts where query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id) group by user_id");
    }

    public function getTagAttempts($tag)
    {
        return \DB::select("select * from query_attempts where query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id)");
    }

    public function getTagAttemptErrors($tag)
    {
        return \DB::select("select * from query_attempts where has_error = 1 and query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id)");
    }

    public function getAvgErrors($tag)
    {
        // $attempts = sizeof($this->getTagAttempts($tag));
        $attempts = $this->getUserAttemptsCount($tag);
        $errors = sizeof($this->getTagAttemptErrors($tag));

        return $attempts == 0 ? "No Attempts" : number_format($errors/$attempts, 2, '.', '');
    }

    public function getAvgTime($tag)
    {
        $attempts = \DB::select("select * from attempt_groups where id in (select attempt_group_id from query_attempts where query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id) group by attempt_group_id)");
        $time = 0;

        foreach ($attempts as $attempt) {
            $time += Carbon::parse($attempt->created_at)->diffInSeconds(Carbon::parse($attempt->endtime));
        }

        return sizeof($attempts) == 0 ? "No Attempts" : floor($time / (sizeof($attempts) * 60)) . ':' . ($time / (sizeof($attempts))) % 60;
    }

    public function getAvgSuccess($tag)
    {
        // $attempts = \DB::select("select * from attempt_groups where id in (select attempt_group_id from query_attempts where query_pool_id in (select query_pool_id from tag_query_pool where tag_id = $tag->id) group by attempt_group_id)");
        $attempts = AG::whereIn('id', QA::select('attempt_group_id')->whereIn('query_pool_id',$tag->pools->pluck('id'))->groupBy('attempt_group_id')->get())->get();

        $successes = 0;
        $trials = 0;
        
        foreach ($attempts as $attempt) {
            $successes += $attempt->hasSuccess();
            $trials += $attempt->trialsToSuccess();
        }


        return count($attempts) == 0 ? "No Attempts" : number_format($successes/count($attempts), 4, '.', '') * 100 . '%';
    }

    public function getAvgTrials($tag)
    {
        $attempts = AG::whereIn('id', QA::select('attempt_group_id')->whereIn('query_pool_id',$tag->pools->pluck('id'))->groupBy('attempt_group_id')->get())->get();

        $successes = 0;
        $trials = 0;
        
        foreach ($attempts as $attempt) {
            if ($attempt->hasSuccess()){
                $trials += $attempt->trialsToSuccess();
            }
        }


        return count($attempts) == 0 ? "No Attempts" : number_format($trials/count($attempts), 2, '.', '');
    }

    public function getPoolIDs($tag)
    {
        return $tag->pools->pluck('id')->toArray();
    }

    public function getGroupIDs($tag)
    {

    }
}