<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['register' => false]);


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.create');
    Route::get('/users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('/users/edit', 'UsersController@update')->name('users.edit');

    Route::get('/datapool', 'DataPoolController@index')->name('datapool.index');
    Route::get('/datapool/create', 'DataPoolController@create')->name('datapool.create');
    Route::post('/datapool/create', 'DataPoolController@store')->name('datapool.create');

    Route::get('/query/create', 'QueryPoolController@create')->name('query.create');
    Route::post('/query/create', 'QueryPoolController@store')->name('query.create');

    Route::get('/query/attempt', 'QueryPoolController@attempt')->name('query.attempt');
    Route::post('/query/attempt', 'QueryPoolController@attemptResult')->name('query.attempt');
});

Route::get('test', function (Illuminate\Http\Request $request) {
    dd(\DB::select('select count(*) as num from lab_3 where project_marks = (select max(project_marks) from lab_3);'));
    dd(json_encode(App\DataPool::all()->pluck('name', 'id')->toArray()));
    dd(\DB::select('select * from t1;'));
    dd("dropped t1, t2 and t3");
});