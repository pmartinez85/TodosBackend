<?php

use Illuminate\Database\Seeder;

class TasksTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->tasks()->saveMany(
                factory(App\Task::class, 5)->create(['user_id' => $user->id])
            );
        });
=======
        factory(App\Task::class, 30)->create();
            //factory('App\Task')->make();
    }
>>>>>>> 4c01b4d0a6cb0b277fe2955aaeed7ffccf05e63a
}
