<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class TaskApiTest
 */
class TaskApiTest extends TestCase
{
    use WithoutMiddleware;
    protected $uri = '/api/task';

    use DatabaseMigrations;

    const DEFAULT_NUMBER_OF_TASKS = 5;

    const DEFAULT_USER_ID = 1;

    public function testShowAllTasks()
    {
        factory(App\Task::class, 10)->create();   // Creem 5 tasques amb la nostra factoria
        $this->json('GET', $this->uri)
            ->seeJson();

        $this->assertCount(10, $this->decodeResponseJson());

        $this->seeJsonStructure([
            '*' => ['id', 'name', 'done', 'priority'],
        ]);
    }
    /**
     * @group failing
     */
    public function testShowOneTask()
    {
        $task = factory(App\Task::class)->create();
        $this->json('GET', $this->uri.'/'.$task->id)
            ->seeJsonStructure(
                ['id', 'name', 'done', 'priority']
            )
            ->seeJsonContains([
                'id'=> $task->id,
            ]);
    }
}
