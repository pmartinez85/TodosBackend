<?php

namespace App\Transformers;

use \App\Transformers\Contracts\Transformer as TransformerContract;

/**
 * Class Transformer
 * @package App\Transformers
 */
abstract class Transformer implements TransformerContract {

    /**
     * @param $resources
     * @return array
     */
    public function transformCollection($resources){
        return array_map(function ($resource) {
            return $this->transform($resource);
        }, $resources);
    }

}