<?php

namespace App\Providers;
use Gate;
use Laravel\Passport\Passport;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        $this->defineGates();




        //
    }

    private function defineGates()
    {
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

//prova inicial

        Gate::define('show-task', function($user) {

            return false;
        });



    }
}
