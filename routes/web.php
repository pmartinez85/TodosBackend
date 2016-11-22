<?php
Route::group(['middleware' => 'auth'],function() {

    Route::get('/', function () {
        return view('welcome');
    });

});

Route::get('/tasks', function () {
    return view('tasks');
});

Route::get('/profile/tokens', function () {
    return view('tokens');
});