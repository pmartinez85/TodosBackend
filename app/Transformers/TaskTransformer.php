<?php

use App\Transformers\Contracts\Transformer\Transformer;

class TaskTransformer implements Transformer
{


    public function transform($resource)
    {
        if (resource instanceof \App\Task){
            throw new IncorrectModelException;
        }
        return [
            'name' => $resource['name'],
            'done' => (boolean)$resource['done'],
            'priority' => (integer)$resource['priority'],

        ];
    }
}
