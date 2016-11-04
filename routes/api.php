<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    Route::resource('task', 'Taskscontroller');
    Route::resource('user', 'UsersController');
    Route::resource('user.task', 'UserTaskController');
    //Route::resource('task.user', 'TaskUserscontroller');
    });
