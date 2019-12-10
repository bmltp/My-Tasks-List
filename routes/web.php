<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function () {
    return redirect()->route('tasks.index');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/react', function () {
    return view('react');
});

Auth::routes();
Route::resource('tasks', 'TaskController');

Route::get('/ajax', [
    'uses' => 'AjaxController@index',
    'as' => 'ajax.index',
]);


Route::group(['prefix' => 'ajax', 'middleware' => 'auth'], function () {
    // Route::post('settings', 'AjaxController@settings');
    Route::get('/ajax/{id}', [
        'uses' => 'AjaxController@show',
        'as'   => 'ajax.show',
    ]);

    Route::post('/ajax/', [
        'uses' => 'AjaxController@store',
        'as'   => 'ajax.store',
    ]);

    Route::put('/ajax/{id}', [
        'uses' => 'AjaxController@update',
        'as'   => 'ajax.update',
    ]);

    Route::delete('/ajax/{id}', [
        'uses' => 'AjaxController@destroy',
        'as'   => 'ajax.destroy',
    ]);
});