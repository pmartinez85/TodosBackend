<?php

namespace App\Http\Controllers;

use App\Exceptions\IncorrectModelException;
use App\Task;

/**
 * Class TaskTransformController
 * @package App\Http\Controllers
 */
class TaskTransformController extends Controller
{

    /**
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    protected function transform($resource)
    {

        if (!$resource instanceOf Task){
        throw new IncorrectModelException();
    }
        return [
            'name'     => $resource['name'],
            'done'     => (bool) $resource['done'],
            'priority' => (int) $resource['priority'],

        ];
    }
}
