<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Filters\TasksFilters;

class TasksController extends Controller
{
    /**
     * Create a new TasksController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of tasks.
     *
     * @param TasksFilters $filters
     * @return \App\Task
     */
    public function index(TasksFilters $filters)
    {
        $tasks = Task::of(auth()->user())->filter($filters)->get();

        if(request()->expectsJson()) {
            return $tasks->toArray();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Task
     */
    public function store()
    {
        $validatedData = request()->validate([
           'body' => 'required',
           'project' => 'exists:projects,id'
        ]);

        return Task::create([
            'body'    => request()->get('body'),
            'project_id' => request()->has('project') ? request('project') : null,
            'user_id' => auth()->id()
        ]);
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
     * @param  Task $task
     */
    public function destroy(Task $task)
    {
       $task->delete();
       
       return response()->json([
            'success' => true
       ]);
    }
}
