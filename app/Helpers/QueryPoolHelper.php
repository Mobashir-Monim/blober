<?php

namespace App\Helpers;

use App\Tag;
use App\QueryPool as QP;
use App\AttemptGroup as AG;
use App\QueryAttempt as QA;
use App\User;

class QueryPoolHelper extends Helper
{
    public function generateDBInsert($request)
    {
        if ($request->result_type == 'query')
            return $this->generateQueryInsert($request);
        else
            return $this->generateOutputInsert($request);
    }

    public function generateQueryInsert($request)
    {
        return [
            'question' => strip_tags($request->question),
            'query' => strip_tags($request->result),
            'output' => json_encode(\DB::select(htmlspecialchars_decode(strip_tags($request->result)))),
            'is_quiz_query' => $request->query_type,
            'difficulty' => $request->difficulty,
            'points' => $request->points,
            'deductible' => $request->deductible,
            'time' => $request->time,
            'data_pool_id' => $request->data_pool_id,
        ];
    }

    public function generateOutputInsert($request)
    {
        return [
            'question' => strip_tags($request->question),
            'output' => $this->processOutput($request->result),
            'is_quiz_query' => $request->query_type,
            'difficulty' => $request->difficulty,
            'points' => $request->points,
            'deductible' => $request->deductible,
            'time' => $request->time,
            'data_pool_id' => $request->data_pool_id,
        ];
    }

    public function processOutput($output)
    {
        $returnee = array();

        foreach (explode('||', strtoupper($this->cleanString(html_entity_decode(strip_tags($output))))) as $item) {
            $item = trim(implode(';', explode('; ', iconv('UTF-8', 'ASCII//IGNORE',  $item))));
            array_push($returnee, $item);
        }

        $returnee = implode('||', $returnee);

        return $returnee;
    }

    public function getAttemptQuery($request)
    {
        $this->flagOpenGroups($request);

        if (sizeof($request->attempted) == 0) {
            return $this->getInitQP($request);
        }
        else {
            return $this->getPostInitQP($request);
        }
    }

    public function getInitQP($request)
    {
        return QP::where('is_quiz_query', false)->
                    whereIn('id', $this->getQueryInTags($request))->
                    select('id', 'question', 'output', 'time', 'points', 'deductible')->
                    get()->shuffle()->first();
    }

    public function getPostInitQP($request)
    {
        return QP::where('is_quiz_query', false)->
                    whereIn('id', $this->getQueryInTags($request))->
                    whereNotIn('id', $request->attempted)->
                    select('id', 'question', 'output', 'time', 'points', 'deductible')->
                    get()->shuffle()->first();
    }

    public function flagOpenGroups($request)
    {
        if (!is_null($request->group)) {
            $group = AG::find($request->group);

            if ($group->flaggable()) {
                $group->flag();
            }
        }
    }

    public function returnAttemptQuery($pool)
    {
        if (is_null($pool)) {
            return $this->returnNullResponse();
        }

        $data = $this->bringTables($pool);

        return response()->json([
            'success' => true,
            'data' => [
                'query' => $pool->toArray(),
                'tables' => $data['tables'],
                'result' => null,
                'names' => $data['names'],
                'group' => $this->createAttemptGroup()->id,
            ],
        ]);
    }

    public function bringTables($pool)
    {
        $data = ['tables' => array(), 'names' => array()];
        
        foreach (QP::find($pool->id)->datapool->tables as $table) {
            array_push($data['tables'], \DB::select('select * from ' . $table->name . ';'));
            array_push($data['names'], $table->name);
        }

        return $data;
    }

    public function returnNullResponse()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'query' => ['id' => null, 'question' => 'No more new questions', 'output' => null, 'time' => null, 'points' => null, 'deductible' => null],
                'tables' => null,
                'result' => null,
                'names' => null,
                'group' => null,
            ],
        ]);
    }

    public function createAttemptGroup()
    {
        return AG::create(['endtime' => null]);
    }

    public function detachAllTags($query)
    {
        foreach ($query->tags->pluck('name', 'id') as $key => $value) {
            dd($key);
        }
    }

    public function attachTags($query, $tags)
    {
        foreach ($tags as $tag) {
            $tag = Tag::where('name', $tag)->first();
            
            if (!is_null($tag)) {
                dd($tag);
                
            }
        }
    }

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
        return [
            'user_id' => User::getUser($request->sessioncode)->id,
            'query_pool_id' => $request->question,
            'is_correct' => false,
            'output' => null,
            'has_error' => false,
            'attempt_group_id' => $request->group
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

    public function getQueryInTags($request)
    {
        $tags = Tag::whereIn('name', $request->tags)->get()->pluck('id');
        $statement = "select distinct query_pool_id from tag_query_pool where tag_id in (";

        foreach ($tags as $key => $tag) {
            if ($key == sizeof($tags) - 1) {
                $statement .= $tag . ");";
            } else {
                $statement .= $tag . ", ";               
            }
        }

        return $this->makeAssocArray(json_decode(json_encode(\DB::select($statement)), true));
    }

    public function makeAssocArray($results)
    {
        $arr = array();

        foreach ($results as $item) {
            array_push($arr, $item['query_pool_id']);
        }

        return $arr;
    }
}