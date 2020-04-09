<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Tag;
use App\Helpers\QueryPoolHelper as QPH;
use App\QuizAttemptGroup as QAG;
use App\QuizAttempt as QiA;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use App\QueryPool as QP;
use App\DataPool as DP;
use App\Table;
use App\User;

class QueryChecker extends Helper
{
    private $is_quiz = null;
    private $system_tables = ['attempt_groups', 'data_pool_table', 'data_pools', 'failed_jobs', 'migrations', 'password_resets', 'students', 'tables', 
                                'query_attempts', 'query_pools', 'quiz_attempt_groups', 'quiz_attempts', 'quiz_sets', 'quizzes', 'role_user', 'roles', 
                                'session_codes', 'tag_query_pool', 'tags', 'users'];

    public function verifyQuery($request, $data, $query)
    {
        $this->is_quiz = !is_null($request->quiz_id);
        $attempt = $this->generateBlankAttemptArray($request);

        if (is_null($query->query)) {
            $data = $this->runMutatingCmd($request, $data, $query);
        } elseif ($this->startsWith(strtolower(explode(" ", $attempt['query'])[0]), 'show')) {
            $data = $this->runShowCmd($attempt['query'], $data, $query);
        } elseif ($this->startsWith(strtolower(explode(" ", $attempt['query'])[0]), 'select')) {
            $data = $this->runSelectCmd($request, $data, $query);
        } else {
            $data['output'] = [['output' => 'The system cannot handle these kind of commands as of yet']];
            $data['error'] = true;
        }

        $this->createQueryAttempt($attempt, $data);

        return $data;
    }

    public function runMutatingCmd($request, $data, $query)
    {
        if  ($this->tableExists($request)) {
            $outputs = explode('||', $query->output);
            $answer = (new QPH)->processOutput($request->answer);
            $data['error'] = false;
            
            foreach ($outputs as $output) {
                if ($output == $answer) {
                    $data['output'] = [['output' => 'Changes made']];
                    $data['result'] = true;

                    return $data;
                }
            }

            $data['output'] = [['output' => 'Incorrect/Erroneous Query']];
        } else {
            $data['output'] = [['output' => 'Table does not exist']];
            $data['error'] = true;
        }
    }

    public function runShowCmd($query, $data, $question)
    {
        if ($query == 'show databases;') {
            $data['output'] = \DB::select("select name from data_pools;");
        } else if ($query == 'show tables;') {
            $dp = $question->datapool;
            $data['output'] = \DB::select("select tables.name from data_pools inner join data_pool_table on data_pools.id = data_pool_table.data_pool_id inner join tables on data_pool_table.table_id = tables.id where data_pools.id = $dp->id");
        } else if ($this->startsWith($query, 'show columns from ')) {
            $data['output'] = [['output' => 'Sorry, you cannot do that.']];
        } else {
            $data['output'] = [['output' => 'You have error in your show command.']];
            $data['error'] = true;
        }

        return $data;
    }

    public function runSelectCmd($request, $data, $query)
    {
        if ($this->tableExists($request)) {
            try { 
                $data['output'] = \DB::select($request->answer);
            } catch(\Illuminate\Database\QueryException $ex){
                $data['error'] = $ex->getMessage();
            }
    
            if (is_null($data['error'])) {
                $data['result'] = $query->output == json_encode($data['output'], true);
            }
        } else {
            $data['output'] = [['output' => 'Table does not exist']];
            $data['error'] = true;
        }

        return $data;
    }

    public function tableExists($request)
    {
        $str = $this->cleanString(strtolower($request->answer));

        foreach ($this->system_tables as $name) {
            if (strpos($str, 'from ' . $name) !== false || strpos($str, 'on ' . $name) !== false || strpos($str, 'table ' . $name) !== false ||
                strpos($str, 'into ' . $name) !== false || strpos($str, 'update ' . $name) !== false) {
                return false;
            }
        }

        return true;
    }

    public function generateBlankAttemptArray($request)
    {
        $arr = $this->generateGenericAttemptArray($request);

        if (!$this->is_quiz) {
            $arr['attempt_group_id'] = $request->group;
        } else {
            $arr['quiz_id'] = $request->quiz_id;
            $arr['quiz_attempt_group_id'] = $request->group;
        }

        $arr['query'] = $this->cleanString($request->answer);

        return $arr;
    }

    public function generateGenericAttemptArray($request)
    {
        return [
            'user_id' => User::getUser($request->sessioncode)->id,
            'query_pool_id' => $request->question,
            'is_correct' => false,
            'output' => null,
            'has_error' => false,
            'query' => $request->answer,
        ];
    }

    public function createQueryAttempt($attempt, $data)
    {
        if (!is_null($data['error'])) {
            $attempt['has_error'] = true;
            $attempt['output'] = $data['error'];
        } else {
            $attempt['is_correct'] = $data['result'];
            $attempt['output'] = json_encode($data['output'], true);
        }

        $this->flagCheckAttempGroup($attempt, $this->is_quiz ? QAG::find($attempt['quiz_attempt_group_id']) : AG::find($attempt['attempt_group_id']));
    }

    public function flagCheckAttempGroup($attempt, $group)
    {
        if ($group->flaggable()) {
            $attempt = $this->is_quiz ? QiA::create($attempt) : QA::create($attempt);

            if ($attempt->is_correct) {
                $attempt->group->flag();
            }
        }
    }
}