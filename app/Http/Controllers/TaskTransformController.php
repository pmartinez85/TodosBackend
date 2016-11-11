<?php

namespace App\Http\Controllers;




class TaskTransformController extends Controller
{
    protected function transform($resource)
    {
        return [
            'name' => $resource['name'],
            'done' => (boolean)$resource['done'],
            'priority' => (integer)$resource['priority'],

        ];
    }


}