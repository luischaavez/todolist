<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        return Project::create([
            'name'    => request('name'),
            'user_id' => auth()->id()
        ]);
    }
}
