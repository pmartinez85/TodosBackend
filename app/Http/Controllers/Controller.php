<?php

namespace App\Http\Controllers;

use App\Transformers\Contracts\Transformer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $transformer;

    /**
     * Controller constructor.
     *
     * @param $transformer
     */
    public function __construct($transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param $resources
     * @param array $metadata
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @internal param $resource
     */
    protected function generatePaginatedResponse($resources, array $metadata = [])
    {
        $paginationData = $this->generatePaginationData($resources);
        $data = [

            'data' => $this->transformer->transformCollections($resources->items()),

        ];

        return Response::json(array_merge($metadata, $paginationData, $data), 200);
    }

    /**
     * @param $resources
     *
     * @return array
     *
     * @internal param $resource
     */
    protected function generatePaginationData($resources)
    {
        /** @var TYPE_NAME $resources */
        $paginationData = [
            'total'         => $resources->total(),
            'per_page'      => $resources->perPage(),
            'current_page'  => $resources->currentPage(),
            'last_page'     => $resources->lastPage(),
            'next_page_url' => $resources->nextPageUrl(),
            'prev_page_url' => $resources->previousPageUrl(),
            'from'          => $resources->firstItem(),
            'to'            => $resources->lastItem(),
        ];

        return $paginationData;
    }

    protected function transform($resources)
    {
        return [
            'name'     => $resources['name'],
            'done'     => (bool) $resources['done'],
            'priority' => (int) $resources['priority'],

        ];
    }

    /**
     * @param $resources
     *
     * @return array
     */
    protected function transformCollection($resources)
    {
        //Collections : Laravel collections

        return array_map(function ($resource) {
            return $this->transformer->transform($resource);
        }, $resources);
    }
}
