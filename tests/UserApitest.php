<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class UsersApiTest.
 */
class UsersApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/user';
    /**
     * Default number of users created in database.
     */
    const DEFAULT_NUMBER_OF_USERS = 5;

    /**
     * Seed database with users.
     *
     * @param int $numberOfUsers to create
     */
    protected function seedDatabaseWithUsers($numberOfUsers = self::DEFAULT_NUMBER_OF_USERS)
    {
        factory(App\User::class, $numberOfUsers)->create();
    }

    /**
     * Create user.
     *
     * @return mixed
     */
    protected function createUser()
    {
        return factory(App\User::class)->make();
    }

    /**
     * Convert user to array.
     *
     * @param $user
     *
     * @return array
     */
    protected function convertUserToArray($user)
    {
        //        return $user->toArray();
        return [
            'name'      => $user['name'],
            'email'     => $user['email'],
            'password'  => $user->password,
            'api_token' => $user->api_token,
        ];
    }

    /**
     * Create and persist user on database.
     *
     * @return mixed
     */
    protected function createAndPersistUser()
    {
        return factory(App\User::class)->create();
    }

    public function userNotAuthenticated()
    {
        $response = $this->json('GET', $this->uri)->getResult();
        //refactor to static call...it is running?
        static::assertEquals(401, $response->status());
    }

    protected function login()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user, 'api');
    }

    /**
     * Test Retrieve all users.
     *
     * @group failing
     *
     * @return void
     */
    public function testRetrieveAllUsers()
    {
        //Seed database
        $this->seedDatabaseWithUsers();

        $this->login();

        $this->json('GET', $this->uri)
            //refactor to static call
            ->seeJsonStructure([
                'propietari',
                'total',
                'per_page',
                'current_page',
                'last_page',
                'next_page_url',
                'prev_page_url',
                'data' => [
                    '*' => [
                        'name',
                        'email',
                    ],
                ],
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_USERS + 1,
                count($this->decodeResponseJson()['data'])
            );
    }

    /**
     * Test Retrieve one user.
     *
     * @group failing
     *
     * @return void
     */
    public function testRetrieveOneUser()
    {
        //Create user in database
        $this->login();
        $user = $this->createAndPersistUser();
        $this->json('GET', $this->uri.'/'.$user->id)
             ->seeJsonStructure(
                ['name', 'email'])
             ->seeJsonContains([
                'name'  => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test Create new user.
     *
     * @group failing
     *
     * @return void
     */
    public function testCreateNewUser()
    {
        $this->login();
        $user = $this->createUser();
        $this->json('POST', $this->uri, $auser = $this->convertUserToArray($user))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('users', $auser);
    }

    /**
     * Test update existing user.
     *
     * @group failing
     *
     * @return void
     */
    public function testUpdateExistingUser()
    {
        $this->login();
        $user = $this->createAndPersistUser();
        $user->name = 'Nou nom dusuari';
        $this->json('PUT', $this->uri.'/'.$user->id, $auser = $this->convertUserToArray($user))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('users', $auser);
    }

    /**
     * Test delete existing user.
     *
     * @group failing
     *
     * @return void
     */
    public function testDeleteExistingUser()
    {
        $this->login();
        $user = $this->createAndPersistUser();
        $this->json('DELETE', $this->uri.'/'.$user->id, $auser = $this->convertUserToArray($user))
            ->seeJson([
                'deleted' => true,
            ])
            ->notSeeInDatabase('users', $auser);
    }

    /**
     * Test not exists.
     *
     * @param $http_method
     */
    protected function testNotExists($http_method)
    {
        $this->login();
        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }

    /**
     * Test get not existing user.
     *
     * @group failing
     *
     * @return void
     */
    public function testGetNotExistingUser()
    {
        $this->testNotExists('GET');
    }

    /**
     * Test delete not existing user.
     *
     * @group failing
     *
     * @return void
     */
    public function testUpdateNotExistingUser()
    {
        $this->testNotExists('PUT');
    }

    /**
     * Test delete not existing user.
     *
     * @group failing
     *
     * @return void
     */
    public function testDeleteNotExistingUser()
    {
        $this->testNotExists('DELETE');
    }

    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //TODO
    }

    //TODO: Test validation

    /**
     * Test name is required and done is set to false and priority to 1.
     *
     * @return void
     */
    public function testNameIsRequiredAndDefaultValues()
    {
        //TODO
    }

    /**
     * Test priority has to be an integer.
     *
     * @return void
     */
    public function testPriorityHasToBeAnInteger()
    {
        //todo
    }

    /**
     * Test done has to be a boolean.
     *
     * @return void
     */
    public function testDoneHasToBeBoolean()
    {
        //TODO
    }
}
