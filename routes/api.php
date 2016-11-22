<?php


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::resource('task', 'Taskscontroller');
    Route::resource('user', 'UsersController');
    Route::resource('user.task', 'UserTaskController');
    //Route::resource('task.user', 'TaskUserscontroller');
});
