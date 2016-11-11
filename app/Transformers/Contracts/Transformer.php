<?php

namespace App\Transformers\Contracts\Transformer;



interface Transformer
{
    public function transform($resource);

    public function transformCollection($resources);

}