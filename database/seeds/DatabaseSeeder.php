<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TasksTablesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersTablesSeeder::class);
        $this->call(AdminUserSeeder::class);
    }
}
