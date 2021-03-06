<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkDatabase', function () {
    if(DB::connection()->getDatabaseName()) {
        echo "connected successfully to database ".DB::connection()->getDatabaseName();
    }
});

Route::group(array('prefix' => 'api/v1'), function() {
    Route::resource('object', 'ObjectController', ['only' => ['store', 'show']]);
});
