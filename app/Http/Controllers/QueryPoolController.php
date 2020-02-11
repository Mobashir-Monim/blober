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
        $query = QP::create((new QPH)->generateDBInsert($request));

        return back();
    }
    
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
        $output = json_encode(\DB::select($request->answer));

        return response()->json([
            'success' => true,
            'data' => [
                'result' => ($query->output == $output),
            ]
        ]);
    }
}