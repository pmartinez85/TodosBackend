<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/11/16
 * Time: 13:06.
 */
namespace App\Http\Controllers;

class UserTransformController extends Controller
{
    protected function transform($resource)
    {
        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],

        ];
    }
}
