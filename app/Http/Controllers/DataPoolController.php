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

    public function getPoolTables(Request $request, $pool)
    {
        $result = null;

        if ($pool == 0) {
            $result = Table::whereNotIn('id', array_column(json_decode(json_encode(\DB::select('select table_id from data_pool_table;')), true), 'table_id'))->get()->pluck('name', 'id')->toArray();
        } else {
            $result = DataPool::find($pool);

            if (is_null($result)) {
                response()->json([
                    'success' => false,
                    'data' => 404,
                ]);
            }

            $result = $result->tables->pluck('name', 'id')->toArray();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'tables' => $result,
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
