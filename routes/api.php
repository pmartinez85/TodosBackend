<?php

use Illuminate\Http\Request;

//Route::resource('task', 'TasksController');
//

Route::group(['prefix' => 'v1'], function () {
    Route::resource('task', 'Taskscontroller');
    });
