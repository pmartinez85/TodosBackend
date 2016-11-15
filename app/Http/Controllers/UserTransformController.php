<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/11/16
 * Time: 13:06.
 */
namespace App\Http\Controllers;

/**
 * Class UserTransformController
 * @package App\Http\Controllers
 */
class UserTransformController extends Controller
{
    /**
     * @param $resource
     * @return array
     */
    protected function transform($resource)
    {
        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],

        ];
    }
}
