<?php

namespace App\Transformers;

use App\Exceptions\IncorrectModelException;

/**
 * Class UserTransformer.
 */
class UserTransformer extends Transformer
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
        if (!$resource instanceof \App\User) {
            throw new IncorrectModelException();
        }

        return [
            'name'  => $resource['name'],
            'email' => $resource['email'],

        ];
    }
}
