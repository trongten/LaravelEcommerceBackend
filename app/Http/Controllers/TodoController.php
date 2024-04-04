<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of todo.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::list();
        return view("todos.index",compact('todos'));
    }

    /**
     * Show the form for creating a new todo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("todos.create");
    }

    /**
     * Store a newly created todo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Todo::store($request);
      return redirect()->action([TodoController::class, 'index']);
    }

    /**
     * Display the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::getById($id);
        return view("todos.edit",compact('todo'));
    }

    /**
     * Update the specified todo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $todo = Todo::updateById($request, $id);
      return redirect()->action([TodoController::class, 'index']);
    }

    /**
     * Remove the specified todo from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::deleteById($id);
        return redirect()->action([TodoController::class, 'index']);
    }
}
