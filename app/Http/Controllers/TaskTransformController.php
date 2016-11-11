<?php

namespace App\Http\Controllers;

class TaskTransformController extends Controller
{
    protected function transform($resource)
    {
        return [
            'name'     => $resource['name'],
            'done'     => (bool) $resource['done'],
            'priority' => (int) $resource['priority'],

        ];
    }
}
