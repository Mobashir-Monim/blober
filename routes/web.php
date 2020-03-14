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

Route::group(['middleware' => ['auth-code']], function () {
    Auth::routes(['register' => false]);
});

Route::group(['middleware' => ['auth', 'auth-code']], function () {
    Route::get('/auth-code/create', 'AuthCodeController@create')->name('auth-code.create');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.create');
    Route::get('/users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('/users/edit', 'UsersController@update')->name('users.edit');

    // Data Pool Routes
    Route::get('/datapool', 'DataPoolController@index')->name('datapool.index');
    Route::get('/datapool/create', 'DataPoolController@create')->name('datapool.create');
    Route::post('/datapool/create', 'DataPoolController@store')->name('datapool.create');

    // Query Pool Routes
    Route::get('/query/create', 'QueryPoolController@create')->name('query.create');
    Route::post('/query/create', 'QueryPoolController@store')->name('query.create');

    // Query Attempt Routtes
    Route::get('/query/attempt', 'QueryPoolController@attempt')->name('query.attempt');
    Route::post('/query/attempt', 'QueryPoolController@attemptResult')->name('query.attempt');

    // Tags Routes
    Route::get('/tags', 'TagsController@index')->name('tags.index');

    // Analytics Routes
    Route::get('/analytics/tags', 'AnalyticsController@tags')->name('analytics.tags');

    // Quiz Routes
    Route::get('/quiz/create', 'QuizController@create')->name('quiz.create');
    Route::post('/quiz/create', 'QuizController@store')->name('quiz.create');
    Route::get('/quiz/panel', 'QuizController@index')->name('quiz.panel');
    Route::get('/quiz/start', 'QuizController@start')->name('quiz.start')->middleware('has-quiz');
});

Route::get('test', function (Illuminate\Http\Request $request) {
    dd('nothing in test');
});