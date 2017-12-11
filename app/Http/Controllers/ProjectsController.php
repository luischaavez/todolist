<?php

namespace App\Http\Controllers;

use App\Project;

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

     /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }
}
