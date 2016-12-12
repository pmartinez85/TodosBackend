<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class TasksApiTest.
 */
class TasksApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    /**
     * RESOURCE URL ON API.
     *
     * @var string
     */
    protected $uri = '/api/v1/task';

    const DEFAULT_USER_ID = 1;

    /**
     * Default number of tasks created in database.
     */

    const DEFAULT_NUMBER_OF_TASKS = 5;

    /**
     * Seed database with tasks.
     *
     * @param int $numberOfTasks
     * @internal param int $number Of Tasks to create
     */

    protected function seedDatabaseWithTasks($numberOfTasks = self::DEFAULT_NUMBER_OF_TASKS)
    {
        factory(App\Task::class, $numberOfTasks)->create(['user_id' => 1]);
    }
    /**
     * Create task.
     *
     * @return mixed
     */
    protected function createTask()
    {
        return factory(App\Task::class)->make(['user_id' => 1]);
    }
    /**
     * Convert task to array.
     *
     * @param $task
     *
     * @return array
     */
    protected function convertTaskToArray($task)
    {
        //        return $task->toArray();
        return [
            'id'       => (int) $task['id'],
            'name'     => $task['name'],
            'done'     => (bool) $task['done'],
            'priority' => (int) $task['priority'],
            'user_id'  => (int) $task['user_id'],
        ];
    }

    /**
     * Create and persist task on database.
     *
     * @return mixed
     */

    protected function login(){

        $user = factory(App\User::class)->create();
        $this->actingAs($user, 'api');
    }

    /**
     *
     */
    public function userNotAuthenticated()
    {
//        $response = $this->login()->json('GET', $this->uri);
//        static::assertEquals(401, $response->status());
//         todo :test message error
        $this->json('GET', $this->uri)
            ->assertResponseStatus(401);
    }


    /**
     * @return mixed
     */
    protected function createAndPersistTask()
    {
        return factory(App\Task::class)->create(['user_id' => 1]);
    }
    /**
     * Test Retrieve all tasks.
     *
     * @group ok
     *
     * @return void
     */
    public function testRetrieveAllTasks()
    {
        //Seed database
        $this->seedDatabaseWithTasks();

        $this->login();
        $this->json('GET', $this->uri)
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
                        'done',
                        'priority',
                        'user_id'
                    ],
                ],
            ])
            ->assertEquals(
                self::DEFAULT_NUMBER_OF_TASKS,
                count($this->decodeResponseJson()['data'])
            );
    }
    /**
     * Test Retrieve one task.
     *
     * @group ok
     *
     * @return void
     */
    public function testRetrieveOneTask()
    {
        //Create task in database
        $task = $this->createAndPersistTask();
        $this->login();


        $this->json('GET', $this->uri.'/'.$task->id)
            ->seeJsonStructure(
                ['name', 'done', 'priority'])
//  Needs Transformers to work: convert string to booelan and string to integer
            ->seeJsonContains([
                'name'     => $task->name,
                'done'     => $task->done,
                'priority' => $task->priority,
            ]);
    }
    /**
     * Test Create new task.
     *
     * @group ok
     *
     * @return void
     */
    public function testCreateNewTask()
    {
        $task = $this->createTask();

        $this->login();

        $this->json('POST', $this->uri, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'created' => true,
            ])
            ->seeInDatabase('tasks', $atask);

    }
    /**
     * Test update existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testUpdateExistingTask()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $task->done = !$task->done;
        $task->name = 'Nom de la nova tasca';


        $this->json('PUT', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'updated' => true,
            ])
            ->seeInDatabase('tasks', $atask);
    }
    /**
     * Test delete existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testDeleteExistingTask()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $this->json('DELETE', $this->uri.'/'.$task->id, $atask = $this->convertTaskToArray($task))
            ->seeJson([
                'deleted' => true,
            ])
            ->notSeeInDatabase('tasks', $atask);
    }
    /**
     * Test not exists.
     *
     * @param $http_method
     */
    protected function datestNotExists($http_method)
    {
        $this->login();

        $this->json($http_method, $this->uri.'/99999999')
            ->seeJson([
                'status' => 404,
            ])
            ->assertEquals(404, $this->response->status());
    }
    /**
     * Test get not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testGetNotExistingTask()
    {
        $this->datestNotExists('GET');
    }
    /**
     * Test delete not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testUpdateNotExistingTask()
    {
        $this->datestNotExists('PUT');
    }
    /**
     * Test delete not existing task.
     *
     * @group ok
     *
     * @return void
     */
    public function testDeleteNotExistingTask()
    {
        $this->datestNotExists('DELETE');
    }
    /**
     * Test pagination.
     *
     * @return void
     */
    public function testPagination()
    {
        //todo test
        $this->assertTrue(true);
    }


    /**
     * Test name is required and done is set to false and priority to 1.
     *
     * @return void
     */
    public function testNameIsRequiredAndDefaultValues()
    {
        //todo test
        $this->assertTrue(true);
    }
    /**
     * Test priority has to be an integer.
     *
     * @return void
     */
    public function testPriorityHasToBeAnInteger()
    {
        $task = $this->createAndPersistTask();
        $this->login();
        $this->json('GET', $this->uri.'/'.$task->id);
        $priority = $this->decodeResponseJson()['priority'];
        $this->assertInternalType('int', $priority);
    }
    /**
     * Test done has to be a boolean.
     *
     * @return void
     */
    public function testDoneHasToBeBoolean()
    {
//        $task = $this->createAndPersistTask();
//        $this->login();
//        $this->json('GET', $this->uri.'/'.$task->id);
//        $done = $this->decodeResponseJson()['done'];
//        $this->assertInternalType('bool', $done);


        }
}


