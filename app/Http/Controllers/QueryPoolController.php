<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryPool as QP;
use App\DataPool as DP;
use App\Helpers\QueryPoolHelper as QPH;

class QueryPoolController extends Controller
{
    public function create()
    {
        return view('querypool.create');
    }

    public function store(Request $request)
    {
        dd(explode(',', $request->tags));

        $query = QP::create((new QPH)->generateDBInsert($request));

        return back();
    }

    // function tdrows($elements)
    // {
    //     $str = "";
    //     foreach ($elements as $element) {
    //         $str .= $element->nodeValue . ", ";
    //     }

    //     return $str;
    // }

    // function getdata($contents)
    // {
    //     $DOM = new \DOMDocument;
    //     libxml_use_internal_errors(true);
    //     $DOM->loadHTML($contents);
    //     libxml_clear_errors();

    //     $items = $DOM->getElementsByTagName('tr');

    //     foreach ($items as $node) {
    //         echo $this->tdrows($node->childNodes) . "<br />";
    //     }
    // }
    
    public function attempt()
    {
        return view('querypool.attempt');
    }

    public function attemptResult()
    {
        dd('In attempt result');
        return;
    }

    public function getQuestions(Request $request)
    {
        $pool = null;
        $tables = array();
        $names = array();

        if (sizeof($request->attempted) == 0) {
            $pool = QP::select('id', 'question', 'output', 'time', 'points', 'deductible')->get()->shuffle()->first();
        }
        else {
            $pool = QP::whereNotIn('id', $request->attempted)->select('id', 'question', 'output', 'time', 'points', 'deductible')->get()->shuffle()->first();
        }

        if (is_null($pool)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'query' => [
                        'id' => null,
                        'question' => 'No more new questions',
                        'output' => null,
                        'time' => null,
                        'points' => null,
                        'deductible' => null,
                    ],
                    'tables' => null,
                    'result' => null,
                    'names' => null,
                ],
            ]);
        }

        foreach (QP::find($pool->id)->datapool->tables as $table) {
            array_push($tables, \DB::select('select * from ' . $table->name . ';'));
            array_push($names, $table->name);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'query' => $pool->toArray(),
                'tables' => $tables,
                'result' => null,
                'names' => $names,
            ],
        ]);
    }

    public function verifyQuery(Request $request)
    {
        $query = QP::find($request->question);
        $data = ['result' => false, 'error' => null, 'output' => null];

        try { 
            $data['output'] = \DB::select($request->answer);
        } catch(\Illuminate\Database\QueryException $ex){
            $data['error'] = $ex->getMessage();
        }

        if (is_null($data['error'])) {
            $data['result'] = $query->output == json_encode($data['output'], true);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}