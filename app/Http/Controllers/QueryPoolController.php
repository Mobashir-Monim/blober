<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueryPool as QP;
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
}