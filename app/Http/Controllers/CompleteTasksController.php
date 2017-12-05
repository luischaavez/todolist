<?php

namespace App\Http\Controllers;

use App\Task;

class CompleteTasksController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Task
     */
    public function store(Task $task)
    {
        $task->markAsComplete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task
     */
    public function destroy(Task $task)
    {
        $task->markAsIncomplete();
    }
}
