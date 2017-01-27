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
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class BasePolicy
 * @package App\Policies
 */
abstract class BasePolicy
{
    use HandlesAuthorization,HasAdmin;

    abstract protected function model();
    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
//    public function view(User $user, Task $task)
//    {
//        if($user->hasPermissionTo('show-task'))
//            return true;
//    }

    public function show(User $user)
    {
        if ($user->hasPermissionTo('show-' . $this->model())) return true;
        return false;
    }

    public function view(User $user, Task $task)
    {
        if ($user->hasPermissionTo('view-' . $this->model())) return true;
        return false;
    }



    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
//    public function create(User $user)
//    {
//        if($user->hasPermissionTo('create-task'))
//            return true;
//    }

    public function create(User $user)
    {
        if ($user->hasPermissionTo('create-' . $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
//    public function update(User $user, Task $task)
//    {
//        if($user->hasPermissionTo('update-task'))
//            //return true;
//            return $user->id == $task->user_id;
//    }

    public function update(User $user, Task $task)
    {
        if ($user->hasPermissionTo('update-' . $this->model())) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
//    public function delete(User $user, Task $task)
//    {
//        if($user->hasPermissionTo('delete-'. $this->model()))
//            return true;
//    }

    public function delete(User $user, Task $task)
    {
        if ($user->hasPermissionTo('delete-' . $this->model())) return true;
        return false;
    }

}