<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class TaskApiTest.
 */
class TaskApiTest extends TestCase
{
    protected $uri = '/api/task';

    use DatabaseMigrations;

    public function testShowAllTasks()
    {
        //        $this->json('GET', $this->uri)   // Mètode + URL
////        ->dump();   // Per veure que ens està tornant
//            ->seeJson();

        $numTasks = 5;
        factory(App\Task::class, $numTasks)->create();   // Creem 5 tasques amb la nostra factoria
        $this->json('GET', $this->uri)
            ->seeJsonStructure([    // Comprovem que l'estructura del Json generat és correcta
                '*' => [
                    'id', 'name', 'done', 'priority',
                ],
            ])
            ->assertEquals(// Comprovem que el número de tasques realitzades és igual al número de respostes Json
                $numTasks,
                count($this->decodeResponseJson())
            );
    }

    /**
     * @group failing
     */
    public function testShowOneTask()
    {
        $task = factory(App\Task::class)->create();
        $this->json('GET', $this->uri.'/'.$task->id)
//            ->dump();
            ->seeJsonStructure(
                ['id', 'name', 'done', 'priority']
            )
            ->seeJsonContains([
                'name' => $task->name,
//                "done" => $task->done,
//                "priority" => $task->priority
            ]);
    }
}
