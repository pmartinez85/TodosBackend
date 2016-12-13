<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 13/12/16
 * Time: 21:41
 */

namespace App\Policies;


/**
 * Class HasAdmin
 * @package App\Policies
 */
trait HasAdmin
{
    /**
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) return true;
    }


}