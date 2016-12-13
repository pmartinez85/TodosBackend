<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 13/12/16
 * Time: 21:49
 */

namespace App\Policies;


use App\Task;
use App\User;

/**
 * Class BasePolicy
 * @package App\Policies
 */
abstract class BasePolicy
{

    abstract protected function model();
    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function show(User $user, Task $task)
    {
        if($user->hasPermissionTo('show-task'))
            return true;
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->hasPermissionTo('create-task'))
            return true;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if($user->hasPermissionTo('update-task'))
            //return true;
            return $user->id == $task->user_id;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if($user->hasPermissionTo('delete-'. $this->model()))
            return true;
    }

}