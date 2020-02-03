<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Datapool;

// Helpers
use App\Helpers\DataPoolHelper as DPH;

class DataPoolController extends Controller
{
    public function index()
    {
        return view('datapool.index');
    }

    public function create()
    {
        return view('datapool.create');
    }

    public function store(Request $request)
    {
        $names = json_decode($request->tableNames, true);
        $tables = json_decode($request->tables, true);
        $helper = new DPH($request->dp_name, $names, $tables);
        // $helper->createTablesWithValues();
        $helper->createDataPoolsWithTables();

        return back();
    }   
}
