<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

/**
 * Class TaskTransformer.
 */
class TaskTransformer extends Transformer
{
    /**
     * @param $resource
     *
     * @throws IncorrectModelException
     *
     * @return array
     */
    public function transform($resource)
    {
        /* @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        if (!$resource instanceof Task) {
            throw new IncorrectModelException();
        }

        return [
            'name'     => $resource['name'],
            'done'     => (bool) $resource['done'],
            'priority' => (int) $resource['priority'],
            'user_id'  => (int) $resource['user_id'],

        ];
    }
}
