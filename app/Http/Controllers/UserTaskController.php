<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Transformers\TaskTransformer;

/**
 * Class UserTaskController
 * @package App\Http\Controllers
 */
class UserTaskController extends Controller
{
    /**
     * TasksController constructor.
     * @param TaskTransformer $transformer
     */
    public function __construct(TaskTransformer $transformer)
    {
        parent::__construct($transformer);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //No metadata
        //Pagination
        //No error message
        //Transformations: hem de transformar el que ensenyem
        dd($id);
        $user = User::findOrFail($id);
        $tasks = $user->tasks()->paginate(15);

        return $this->generatePaginatedResponse($tasks, ['propietari' => 'Pedro Martínez']);

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
     * @param $iduser
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $iduser)
    {
        //        $request->input('name')
        $user = User::findOrFail($iduser);
        Task::create($request->only(['name', 'done', 'priority', $user->id]));

        return response([
            'error'   => false,
            'created' => true,
            'message' => 'Tasca del usuari creada correctament',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $iduser
     * @param $idtask
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);

        return $this->transform($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $iduser
     * @param $idtask
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Request $request, $iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->edit($request->only(['name', 'done', 'priority', 'user_id']));

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Tasca del usuari editada correctament',
        ], 200);
    }

    public function update(Request $request, $iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->update($request->only(['name', 'done', 'priority', 'user_id']));

        return response([
            'error'   => false,
            'updated' => true,
            'message' => 'Tasca del usuari actualitzada correctament',
        ], 200);
    }

    public function destroy($iduser, $idtask)
    {
        $user = User::findOrFail($iduser);
        $task = $user->tasks()->findOrFail($idtask);
        $task->destroy();

        return response([
            'error'   => false,
            'deleted' => true,
            'message' => 'Tasca esborrada correctament',
        ], 200);
    }
}
