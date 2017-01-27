<?php

//Amb middleware!!

Route::group(['prefix' => 'v1', 'middleware' => ['cors','auth:api']], function () {
        Route::resource('task', 'Taskscontroller');
        Route::resource('user', 'UsersController');
        Route::resource('user.task', 'UserTaskController');
    Route::get('/user', function (Request $request){
        return $request->user();
    });
});


//Sense middleware!!


//Route::group(['prefix' => 'v1'], function () {
//        Route::resource('task', 'Taskscontroller');
//        Route::resource('user', 'UsersController');
//        Route::resource('user.task', 'UserTaskController');
//});