<?php
namespace App\Repositories;

use App\Repositories\Contracts\Repository;
use App\Task;

/**
 * Class TaskRepository
 * @package App\Repositories
 */
class TaskRepository implements Repository
{

    /**
     * @param $id
     * @param array $columns
     */
    public function find($id, $columns = array('*'))
    {
        return Task::findOrFail($id);
    }
}