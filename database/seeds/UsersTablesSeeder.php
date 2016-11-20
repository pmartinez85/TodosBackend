<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersTablesSeeder
 */
class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->create();
    }
}
