<?php

//Amb middleware!!

//Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
//        Route::resource('task', 'Taskscontroller');
//        Route::resource('user', 'UsersController');
//        Route::resource('user.task', 'UserTaskController');
//        //Route::resource('task.user', 'TaskUserscontroller');
//
//});


//Sense middleware!!


Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => 'can:show,App\User'], function () {
        Route::resource('task', 'Taskscontroller');
        Route::resource('user', 'UsersController');
        Route::resource('user.task', 'UserTaskController');
        //Route::resource('task.user', 'TaskUserscontroller');
    });
});