<?php

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy extends BasePolicy
{
    use HandlesAuthorization, HasAdmin;

    /**
     * @return string
     */
    protected function model()
    {
        return 'user';

    }

}
