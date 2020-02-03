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
});

Route::get('test', function (Illuminate\Http\Request $request) {
    dd(sizeof(\DB::select('select * from data_pool_table where table_id = 3 and data_pool_id = 2')));
    dd("dropped t1, t2 and t3");
});