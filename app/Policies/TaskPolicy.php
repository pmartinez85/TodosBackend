<?php

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaskPolicy
 * @package App\Policies
 */
class TaskPolicy extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * @return string
     */
    protected function model()
    {
        return 'task';

    }

}
