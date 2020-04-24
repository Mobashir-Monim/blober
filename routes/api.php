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
Route::post('/query/{dp}/get', 'QueryPoolController@getQueries')->name('querypool.verify-query');

Route::post('/quiz/submit-query', 'QuizController@verifyQuery')->name('quiz.verify-query');
Route::post('/quiz/{quiz}/delete', 'QuizController@deleteQuiz')->name('quiz.delete');
Route::post('/quiz/{quiz}/show', 'QuizController@show')->name('quiz.show');

Route::post('/user/get', 'UsersController@get')->name('user.get');
Route::post('/user/update', 'UsersController@update')->name('user.get');

Route::post('/tags', 'TagsController@store')->name('tags.store');
Route::post('/tags/{tag}', 'TagsController@update')->name('tags.update');