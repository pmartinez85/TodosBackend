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
        factory(App\Tasks::class,30)->create();
            factory('App\Task')->make();
    }
}
