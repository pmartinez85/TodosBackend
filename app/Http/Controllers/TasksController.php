<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1)No metadata
        //2)Pagination --> no podem ensenyar un json en 200 tasques...
        //hem d'ensenyar les tasques necessaries i les seves metadates
        //3)No error message -->Hem de mostrar errors en la nostra API
        //4)Transformacions --> Hem de transformar el que ensenyem


        $tasks = Task::all();

        return Response::json([
            'propietari' => 'pedro Martinez',
            'total' => $tasks->total(),
            'subtotal'=>$tasks->subtotal(),
            'data' => $tasks->toArray()
        ],200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create($request->input());
        //input sense parametre retorna tot
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Task::findOrFail($id);
        }catch (\Exeception $e){
            return Response::json([
                "Error"=>"Hi ha hagut una exepció"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
