<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use App\QueryPool as QP;
use App\Helpers\AnalyticsHelper as AH;

class AnalyticsController extends Controller
{
    public function tags()
    {
        $tags = Tag::all();
        $headers = ['Tag Name', 'No of attempts', 'No of user attempts', 'Average Errors', 'Average Time', 'Success Rate', 'Average Trials to Success'];
        $helper = new AH;
        ['Tag', 0, 0, 0, 0, 0, 0, 0];
        $vals = array();

        foreach ($tags as $tag) {
            array_push($vals, [
                $tag->name,
                $helper->getUserAttemptsCount($tag),
                $helper->getAttemptGroupsCount($tag),
                $helper->getAvgErrors($tag),
                $helper->getAvgTime($tag),
                $helper->getAvgSuccess($tag),
                $helper->getAvgTrials($tag)]);
        }
        
        return view('analytics.tags', compact('headers', 'vals'));
    }
}
