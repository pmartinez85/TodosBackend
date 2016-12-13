<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;
use Illuminate\Http\Request;
use Response;
use App\Transformers\TaskTransformer;
use App\Repositories\TaskRepository;

/**
 * Exemple de documentació:
 * Class TasksController  ->> titol
 *
 * Descripció de la classe!!  ->> descripció
 *
 * @package App\Http\Controllers ->> Etiquetes!!
 */

class TasksController extends Controller
{
    /**
     * La documentacio ens diu que aquesta variable es de tipus objecte taskrepository
     *
     * @var TaskRepository
     */

    protected $repository;


    /**
     * TasksController constructor.
     * @param TaskTransformer $transformer
     * @param TaskRepository $repository
     */
    public function __construct(TaskTransformer $transformer, TaskRepository $repository)

    {
        parent::__construct($transformer);

        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
            $tasks = Task::paginate(15);

            return $this->generatePaginatedResponse($tasks, ['propietari' => 'Pedro Martinez']);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (!$request->has('user_id')) {
            $request->merge(['user_id' => Auth::id()]);
        }
        Task::create($request->all());

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Tasca creada correctament',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       // $task = Task::findOrFail($id);
        /** @noinspection PhpVariableVariableInspection */
        $task = $this->repository->find($id);

        return $this->transformer->transform($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Task::findOrFail($id)->update($request->all());

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Tasca actualitzada correctament',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Tasca esborrada correctament',
        ], 200);
    }
}
