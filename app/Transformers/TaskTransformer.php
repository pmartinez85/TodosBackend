<?php
namespace App\Transformers;

use App\Exceptions\IncorrectModelException;
use App\Task;

/**
 * Class TaskTransformer
 * @package App\Transformers
 */
class TaskTransformer extends Transformer
{
    /**
     * @param $resource
     * @return array
     * @throws IncorrectModelException
     */
    public function transform($resource)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
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
