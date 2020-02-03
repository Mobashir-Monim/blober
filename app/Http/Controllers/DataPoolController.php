<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\DataPool;
use App\Table;

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
        $helper->createTablesWithValues();
        $helper->createDataPoolsWithTables();

        return back();
    }   

    public function getPoolTables(Request $request, DataPool $pool)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'tables' => $pool->tables->pluck('name', 'id')->toArray(),
            ]
        ]);
    }

    public function getTablesData(Request $request, Table $table)
    {
        $data = array();
        array_push($data, array());
        array_push($data, array());
        $headers = \DB::select("describe " . $table->name . ";");

        foreach($headers as $key => $value) {
            array_push($data[0], $value->Field);
            array_push($data[1], $value->Type);
        }

        $tableData = \DB::select("select * from " . $table->name . ";");

        foreach($tableData as $d) {
            array_push($data, $d);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
