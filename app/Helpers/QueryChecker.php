<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Tag;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use App\QueryPool as QP;
use App\User;

class QueryChecker extends Helper
{
    public function verifyQuery($request, $data, $query)
    {
        $attempt = $this->generateBlankAttemptArray($request);

        try { 
            $data['output'] = \DB::select($request->answer);
        } catch(\Illuminate\Database\QueryException $ex){
            $data['error'] = $ex->getMessage();
        }

        if (is_null($data['error'])) {
            $data['result'] = $query->output == json_encode($data['output'], true);
        }

        $this->createQueryAttempt($attempt, $data);

        return $data;
    }

    public function generateBlankAttemptArray($request)
    {
        $arr = $this->generateGenericAttemptArray($request);

        if (is_null($request->quiz_id)) {
            $arr['attempt_group_id'] = $request->group;
        } else {
            $arr['quiz_id'] = $request->quiz_id;
            $arr['quiz_attempt_group_id'] = $request->group;

        }

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

        $this->flagCheckAttempGroup($attempt);
    }

    public function flagCheckAttempGroup($attempt)
    {
        if (AG::find($attempt['attempt_group_id'])->flaggable()) {
            $attempt = QA::create($attempt);

            if ($attempt->is_correct) {
                $attempt->group->flag();
            }
        }
    }
}