<?php
Route::group(['middleware' => 'auth'],function() {
    Route::get('/tasks', function () {
        return view('tasks');
    });
});

Route::get('/profile/tokens', function () {
    return view('tokens');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/phpinfo', function () {
    phpinfo();
});





Gate::define('easy-gate', function(){

    return true; //usuari autoritzat

});


Gate::define('impossible-gate', function(){

    return false; //usauri no autoritzat

});

// Usuari propietari

Gate::define('update-task', function($user, $task) {

        return $user->id == $task->user_id;
});


//usuari admin

Gate::define('update-task1', function($user) {

    return $user->isAdmin(); //no tenim aquest mètode encara
});

//Usuari admin i usuari propietari

Gate::define('update-task2', function($user, $task) {

    if ($user->isAdmin()) return true;

    return $user->id == $task->user_id;
});

//usuari admin, propietari i usuari editor

Gate::define('update-task3', function($user, $task) {

    if ($user->isAdmin()) return true;
    if($user->hasRole('editor')) return true;

    return $user->id == $task->user_id;
});




