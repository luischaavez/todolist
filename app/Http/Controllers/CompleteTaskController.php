<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class CompleteTaskController extends Controller
{
    public function store(Task $task)
    {
        $task->markAsComplete();
    }

    public function destroy(Task $task)
    {
        $task->markAsIncomplete();
    }
}
