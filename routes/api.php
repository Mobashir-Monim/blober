<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/datapools/{pool}', 'DataPoolController@getPoolTables')->name('datapools.tables.get');
Route::get('/datapools/tables/{table}', 'DataPoolController@getTablesData')->name('datapools.tables.data.get');
Route::post('/query/get-question', 'QueryPoolController@getQuestions')->name('querypool.get-question');
Route::post('/query/submit-query', 'QueryPoolController@verifyQuery')->name('querypool.verify-query');
