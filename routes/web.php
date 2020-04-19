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
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/{email}', 'HomeController@dashboard')->name('home.user');
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.create');
    Route::get('/users/edit', 'UsersController@edit')->name('users.edit');
    Route::post('/users/edit', 'UsersController@update')->name('users.edit');

    // Data Pool Routes
    Route::get('/datapool', 'DataPoolController@index')->name('datapool.index');
    Route::get('/datapool/create', 'DataPoolController@create')->name('datapool.create');
    Route::post('/datapool/create', 'DataPoolController@store')->name('datapool.create');

    // Query Pool Routes
    Route::get('/queries', 'QueryPoolController@index')->name('query.index');
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
    Route::get('/quizzes', 'QuizController@index')->name('quiz.index');
    Route::get('/quiz/create', 'QuizController@create')->name('quiz.create');
    Route::post('/quiz/create', 'QuizController@store')->name('quiz.create');
    Route::get('/quiz/{quiz}/edit', 'QuizController@edit')->name('quiz.edit');
    Route::post('/quiz/{quiz}/edit', 'QuizController@update')->name('quiz.edit');
    Route::get('/quiz/panel', 'QuizController@panel')->name('quiz.panel')->middleware('has-quiz');
    Route::get('/quiz/start', 'QuizController@start')->name('quiz.start')->middleware(['has-quiz', 'valid-link', 'valid-set']);
    Route::get('/quiz/invalid', 'QuizController@invalid')->name('quiz.invalid');
    Route::get('/quiz/score/{quiz}', 'QuizController@export')->name('quiz.score.export');

    // Section Routes
    Route::get('/sections', 'SectionController@index')->name('sections.index');
});

Route::get('test', function (Illuminate\Http\Request $request) {
    return view('test');
    dd(phpinfo());
});

Route::get('testm/{quiz}', 'QuizController@show');