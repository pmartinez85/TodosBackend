<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    Route::resource('task', 'Taskscontroller');
    Route::resource('user', 'Userscontroller');
    });


//Route::resource('task', 'Taskscontroller');
//Route::resource('user', 'Userscontroller');