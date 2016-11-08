<?php

class UserTransformer implements Transformer
{
    public function transform($resource)
    {
        if (resource instanceof \App\Task) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],

        ];
    }
}
