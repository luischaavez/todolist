<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }


    public function store()
    {
        return Task::create([
           "task"    => request()->get("task"),
           "user_id" => auth()->id()
        ]);
    }
}
