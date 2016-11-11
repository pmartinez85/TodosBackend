<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Response;
use App\Transformers\TaskTransformer;

use App\Repositories\TaskRepository;

class TasksController extends Controller
{
   protected $repository;

    public function __construct(TaskTransformer $transformer, TaskRepository $repository)

    {
        parent::__construct($transformer);

        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
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

        $task = Task::findOrFail($id);
        $task->$this->repository->find($id);

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
