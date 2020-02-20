<?php

namespace App\Helpers;

use App\Tag;

class QueryPoolHelper
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
            'output' => json_encode($request->output),
            'difficulty' => $request->difficulty,
            'points' => $request->points,
            'deductible' => $request->deductible,
            'time' => $request->time,
            'data_pool_id' => $request->data_pool_id,
        ];
    }

    public function attachTags($query, $tags)
    {
        foreach ($tags as $tag) {
            $tag = Tag::where('name', $tag)->first();
            
            if (!is_null($tag)) {
                $query->tags()->attach($tag->id);
            }
        }
    }

    public function verifyQuery($request, $data, $query)
    {
        try { 
            $data['output'] = \DB::select($request->answer);
        } catch(\Illuminate\Database\QueryException $ex){
            $data['error'] = $ex->getMessage();
        }

        if (is_null($data['error'])) {
            $data['result'] = $query->output == json_encode($data['output'], true);
        }

        return $data;
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