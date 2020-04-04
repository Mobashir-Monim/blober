<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryPool as QP;
use App\DataPool as DP;
use App\Helpers\QueryPoolHelper as QPH;
use App\Helpers\QueryChecker as QCH;
use App\Tag;
use App\User;

class QueryPoolController extends Controller
{
    public function create()
    {
        return view('querypool.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $query = QP::create((new QPH)->generateDBInsert($request));
        (new QPH)->attachTags($query, explode(',', $request->tags));

        return back();
    }

    public function index()
    {
        dd('Under Development');
    }
    
    public function attempt()
    {
        return view('querypool.attempt');
    }

    public function getQuestions(Request $request)
    {
        $pool = (new QPH)->getAttemptQuery($request);

        return (new QPH)->returnAttemptQuery($pool);
    }

    public function verifyQuery(Request $request)
    {
        $query = QP::find($request->question);
        $data = (new QCH)->verifyQuery($request, ['result' => false, 'error' => null, 'output' => null], $query);
        $student = User::getUser($request->sessioncode)->student;

        if ($data['result']) {
            $student->points += $query->points;
        } else {
            $student->points -=  $query->deductible;
        }

        $student->save();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}