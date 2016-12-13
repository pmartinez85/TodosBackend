<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Role;

/**
 * Class TaskControllerTest
 */
class TaskControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthorizedIndex()
    {

        $user = $this->login();
        Role::create(["name" => "admin"]);
        $user->assignRole('admin');
        $this->get('tasks');
        $this->assertResponseOk();
    }

    public function testNotAuthorizedIndex()
    {
        $this->login();
        $this->get('tasks');
        $this->assertResponseStatus(403);
    }


    /**
     * @return mixed
     */
    protected function login(){

        $user = factory(\App\User::class)->create();
        $this-> actingAs($user);
        return $user;

    }
}
