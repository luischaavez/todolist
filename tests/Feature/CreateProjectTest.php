<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\{ Project, Task, User };
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_create_a_new_project()
    {
        $this->signIn();

        $project = factory(Project::class)->make([
            'user_id' => auth()->id()
        ]);

        $this->post(route('projects.store'), $project->toArray());

        $this->assertDatabaseHas('projects', [
           'name'    => $project->name,
           'user_id' => $project->user->id
        ]);
    }

    /** @test */
    function authorized_users_can_delete_projects()
    {
        $this->signIn();
        
        $project = factory(Project::class)->create([
            'user_id' => auth()->id()
        ]);

        $this->json('DELETE', route('projects.destroy', $project));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    /** @test */
    function tasks_are_deleted_when_a_project_is_deleted()
    {
        $project = factory(Project::class)->create();

        $task = factory(Task::class)->create([
            'project_id' => $project->id,
            'user_id' => $project->user_id
        ]);

        $this->actingAs($project->user)
            ->json('DELETE', route('projects.destroy', $project))
            ->assertStatus(200);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);    
    }
}
